<?php

namespace App\Http\Controllers;

use App\Business\Location;
use App\Http\GraphQLClient;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class LocationController extends Controller
{
    public function view($id)
    {
        $request = 'id: ' . $id;

        $client = new GraphQLClient();
        $client->setParams("location");
        $client->setData([
            'id',
            'business {id name slug picture picture_100(width:100, height: 100) picture_50(width:50, height: 50)}',
            'name',
            'latitude',
            'longitude',
            'phone',
            'phone_code',
            'assign_amenities {id name key}',
            'jobs_count_open',
            'jobs_count',
            'street',
            'street_number',
            'region',
            'city',
            'country',
            'country_code'
        ], $request);
        $data = $client->request();

        return view('common.job.jobs_locations', [
            'data' => $data
        ]);
    }

    /**
     * @param Request $request
     * @param $param
     * @param bool $param2
     * @param bool $param3
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewByLocationPart(Request $request, $param, $param2 = false, $param3 = false)
    {
        switch ($request->segment(2)) {
            case 'country':
                return view('common.job_map', [
                    'country' => $param,
                    'type' => 'country'
                ]);
                break;
            case 'region':
                return view('common.job_map_region', [
                    'region' => $param,
                    'country' => $param2,
                    'type' => 'region'
                ]);
                break;
            case 'city':
                return view('common.job_map_city', [
                    'city' => $param,
                    'country' => $param2,
                    'type' => 'city'
                ]);
                break;
            case 'street':
                return view('common.job_map_street', [
                    'street' => $param,
                    'city' => $param2,
                    'country' => $param3,
                    'type' => 'street'
                ]);
                break;
            case 'address':
                $streetData = explode("+", $param);
                $number = $streetData[0];
                $street = ($streetData[1]) ?? '';
                return view('common.job_map_address', [
                    'number' => $number,
                    'street' => $street,
                    'city' => $param2,
                    'country' => $param3,
                    'type' => 'address'
                ]);
                break;
        }
    }

    public function addBusinessesLocations ()
    {

        set_time_limit(0);
        ini_set('MAX_EXECUTION_TIME', 86400);
        ini_set('MAX_EXECUTION_TIME', -1);

        $userID = 1;
        $reader = new Xlsx();

        $spreadsheet = $reader->load('MTY full list.xlsx');
        $spreadsheet->setActiveSheetIndex(0);

        $worksheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $isFirst = true;
        $business = null;
        $businessPrev = null;

        foreach ($worksheet as $row) {
            try {
                $city = $row['D'];

                $street = $row['C'];
                $pos = stripos($street, ',');
                if ($pos !== false) {
                    $street = substr($street, $pos + 1);
                }
                $pos = stripos($street, ',');
                if ($pos !== false) {
                    $street = substr($street, 0, $pos);
                }
                $street = trim($street);

                $nameBusiness = $row['B'];
                $nameLocation = $row['A'];

                $client = new GraphQLClient();
                $client->setParams("geo");
                $client->addRequest([
                    'key' => $city
                ]);
                $client->addResponse([
                    'city',
                    'region',
                    'country',
                    'countryCode',
                ]);
                $address = $client->request();
                if (count($address) > 0) {
                    $address = $address[0];

                    $url = "https://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=" . urlencode($row['C']) . "&key=AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE";
                    $resp_json = file_get_contents($url);
                    $resp = json_decode($resp_json, true);
                    $lati = 0;
                    $longi = 0;
                    if ($resp['status'] == 'OK') {
                        $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
                        $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
                        $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
                    }

                    if ($isFirst || ($businessPrev && $businessPrev->name != $nameBusiness)) {
                        $client = new GraphQLClient();
                        $client->setParams("createBusiness", 'mutation');
                        $client->addRequest([
                            'name' => $nameBusiness,
                            'name_fr' => $nameBusiness,
                            'description' => $nameBusiness,
                            'description_fr' => $nameBusiness,
                            'industry_id' => 1,
                            'size_id' => 1,
                            'street' => $street,
                            'street_number' => '1',
                            'phone' => '1',
                            'phone_code' => '+380',
                            'phone_country_code' => $address->countryCode,
                            'zip_code' => '1',
                            'city' => $address->city,
                            'region' => $address->region,
                            'country' => $address->country,
                            'country_code' => $address->countryCode,
                            'type' => 'private',
                            'language_prefix' => 'en',
                            'latitude' => $lati,
                            'longitude' => $longi,
                            'logo' => '',
                            'logo_data' => '',
                        ]);
                        $client->addResponse([
                            'id',
                            'name',
                            'slug',
                            'localized_name',
                        ]);
                        $business = $client->request();
                        $isFirst = false;
                        $businessPrev = $business;
                        echo 'add business ' . $nameBusiness . '<br>';
                    } else {
                        $location = new Location();
                        $location->name = $nameLocation;
                        $location->street = $street;
                        $location->street_number = '1';
                        $location->suite = '';
                        $location->city = $address->city;
                        $location->region = $address->region;
                        $location->country = $address->country;
                        $location->country_code = $address->countryCode;
                        $location->phone_country_code = $address->countryCode;
                        $location->phone_code = '+380';
                        $location->phone = '1';
                        $location->latitude = $lati;
                        $location->longitude = $longi;
                        $location->type = 'location';
                        $location->business_id = $business->id;
                        $location->user_id = $userID;
                        $location->save();
                        echo 'add location ' . $nameLocation . '<br>';
                    }
                } else {
                    echo 'no address ' . $city . ' in GEO <br>';
                }
            } catch (\Exception $exception) {
                echo 'unknown error ' . $city . '<br>';
            }
        }

    }

}
