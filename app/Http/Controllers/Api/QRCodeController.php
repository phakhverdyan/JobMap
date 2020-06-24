<?php

namespace App\Http\Controllers\Api;


use App\Business;
use App\Business\Administrator;
use App\Business\Location;
use App\QRCodeSetting;
use App\QRCodeLib\QRCode;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Barryvdh\DomPDF\Facade as PDF;

use Intervention\Image\Facades\Image;
use niklasravnsborg\LaravelPdf\Facades\Pdf as MPDF;



class QRCodeController extends Controller
{

    public function getQrCodeSetting(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }
        $data = "<option value='0'>Empty</option>";
        $business_id = (int)$request->input('business_id', 0);
        $QRCodeSetting = QRCodeSetting::where("business_id", $business_id)->get()->all();
        if(!empty($QRCodeSetting)){
            foreach ($QRCodeSetting as $item){
                $data .= '<option value="'.$item->id.'" data-name="'.$item->name.'">'.$item->name.'</option>';
            }
        }else{
            $data = null;
        }
        return response(['data' => $data], 200);
    }

    public function updateQrCodeSetting(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }

        $business_id = (int)$request->input('business_id', 0);
        $setting_name = $request->input('setting_name', "");
        $setting_id = (int)$request->input('setting_id', 0);
        $outEyeColor = $request->input('outEyeColor', "");
        $innerEyeColor = $request->input('innerEyeColor', "");
        $backgroundColor = $request->input('backgroundColor', "");
        $singleColor = $request->input('singleColor', "");
        $url = $request->input('url', "");
        $file_name = $request->input('file_name', "");

        $QRCodeSetting = QRCodeSetting::where("business_id", $business_id)->where("id", $setting_id)->first();
        if(empty($QRCodeSetting)){
            $QRCodeSetting = new QRCodeSetting();
        }

        $QRCodeSetting->business_id = $business_id;
        $QRCodeSetting->name = $setting_name;
        $QRCodeSetting->out_eye = $outEyeColor;
        $QRCodeSetting->inner_eye = $innerEyeColor;
        $QRCodeSetting->single = $singleColor;
        $QRCodeSetting->background = $backgroundColor;
        $QRCodeSetting->logo_data = $file_name;
        $QRCodeSetting->save();
        $current_id = $QRCodeSetting->id;

        $fileName = md5('qr-code-setting' . $business_id);
        $originalImage = $fileName . '.png';

        if($file_name !== $originalImage){
            Storage::delete('qr-code/'. $business_id."/".$originalImage);
            Storage::copy('qr-code/'. $business_id.'/'.$file_name, 'qr-code/'. $business_id."/".$originalImage);
        }

        $QRCodeSetting->logo_data = $originalImage;
        $QRCodeSetting->save();

        $data = "<option value='0'>Select</option>";
        $QRCodeSetting = QRCodeSetting::where("business_id", $business_id)->get()->all();
        if(!empty($QRCodeSetting)){
            foreach ($QRCodeSetting as $item){
                $data .= '<option value="'.$item->id.'" data-name="'.$item->name.'">'.$item->name.'</option>';
            }
        }
        return response(['data' => $data, "current_id" => $current_id], 200);
    }

    public function GenerateCode(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }
        $qr_data = $request->input('data', \url("/scan/"));
        $business_id = (int)$request->input('business_id', 0);
        $location_id = (int)$request->input('location_id', 0);
        $setting_id = (int)$request->input('setting_id', 0);
        $setting_change = (int)$request->input('setting_change', 0);
        $outEyeColor = $request->input('outEyeColor', "");
        $innerEyeColor = $request->input('innerEyeColor', "");
        //$backgroundColor = $request->input('backgroundColor', "");
        $singleColor = $request->input('singleColor', "");
        $url = $request->input('url', "");
        $file_name = $request->input('file_name', "");
        $size = (int)$request->input('size', 600);

        $isLogoData = false;
        $logoPath = public_path()."/img/jm_logo.png";
        if($file_name == ""){
            $Location = Business\Location::where("id", $location_id)->first();
            if(!empty($Location) && $Location->picture){
                $logoPath = Storage::disk('business')->path($business_id."/logo/crop_".$Location->picture);
            }else{
                $Business = Business::where("id", $business_id)->first();
                if(!empty($Business) && $Business->picture){
                    $logoPath = Storage::disk('business')->path($business_id."/logo/crop_".$Business->picture);
                }
            }
        }else{
            $logoPath = storage_path("app/qr-code/".$business_id."/".$file_name);
            $isLogoData = false;
        }

        if(!file_exists($logoPath)){
            $logoPath = public_path()."/img/jm_logo.png";
        }

        $_setting = null;
        $QRCodeSetting = QRCodeSetting::where("business_id", $business_id)->where("id", $setting_id)->first();
        if(!empty($QRCodeSetting) && $setting_change == 1){
            if($QRCodeSetting->out_eye !== null){
                $outEyeColor = $QRCodeSetting->out_eye;
            }

            if($QRCodeSetting->inner_eye !== null){
                $innerEyeColor = $QRCodeSetting->inner_eye;
            }

            if($QRCodeSetting->single !== null){
                $singleColor = $QRCodeSetting->single;
            }

//            if($QRCodeSetting->background !== null){
//                $backgroundColor = $QRCodeSetting->background;
//            }

            if($QRCodeSetting->logo_data !== null && Storage::exists("qr-code/".$business_id."/".$QRCodeSetting->logo_data)){
                $logoPath = storage_path("app/qr-code/".$business_id."/".$QRCodeSetting->logo_data);
                $file_name = $QRCodeSetting->logo_data;
                $isLogoData = false;
            }
        }

        $QRCode = new QRCode($qr_data, $logoPath, $isLogoData, $size, "FFFFFF", $singleColor, $outEyeColor, $innerEyeColor);

        if($file_name != ""){
            $_setting['logo_url'] = '/qr-code/' . $business_id.'/'.$file_name;
            $_setting['file_name'] = $file_name;
        }


        if(empty($backgroundColor)){
            $_setting['background'] = $QRCode->getBackgroundHex();
        }else{
            $_setting['background'] = $backgroundColor;
        }

        if(empty($singleColor)){
            $_setting['single'] = $QRCode->getSingleHex();
        }else{
            $_setting['single'] = $singleColor;
        }

        if(empty($outEyeColor)){
            $_setting['out_eye'] = $QRCode->getOutEyeHex();
        }else{
            $_setting['out_eye'] = $outEyeColor;
        }

        if(empty($innerEyeColor)){
            $_setting['inner_eye'] = $QRCode->getInnerEyeHex();
        }else{
            $_setting['inner_eye'] = $innerEyeColor;
        }

        ob_start();

        echo  $QRCode->getRendererSvg();

        $svg = ob_get_contents();

        ob_clean();

        return response(['data' => ["svg" => $svg, "setting" => $_setting]], 200);
    }

    public function getPDFCode(Request $request){
        if(!auth()->user()){
            return response(['error' => 'auth user error'], 500);
        }
        $location_id = $request->input('location_id', 0);
        $business_id = $request->input('business_id', 0);
        $qr_data = $request->input('data', \url("/scan/"));
        $title_one = $request->input('title_one', "Scan & Apply");
        $title_two = $request->input('title_two', "Scan & Apply");
        $title_one_size = $request->input('title_one_size', 3);
        $title_two_size = $request->input('title_two_size', 3);
        $title_one_color = $request->input('title_one_color', "000000");
        $title_two_color = $request->input('title_two_color', "000000");

        $setting_id = (int)$request->input('setting_id', 0);
        $setting_change = (int)$request->input('setting_change', 0);
        $outEyeColor = $request->input('outEyeColor', "");
        $innerEyeColor = $request->input('innerEyeColor', "");
        $singleColor = $request->input('singleColor', "");
        $url = $request->input('url', "");
        $file_name = $request->input('file_name', "");
        $size = (int)$request->input('size', 2000);

        $isLogoData = false;
        $logoPath = public_path()."/img/jm_logo.png";
        if($file_name == ""){
            $Location = Business\Location::where("id", $location_id)->first();
            if(!empty($Location) && $Location->picture){
                $logoPath = Storage::disk('business')->path($business_id."/logo/crop_".$Location->picture);
            }else{
                $Business = Business::where("id", $business_id)->first();
                if(!empty($Business) && $Business->picture){
                    $logoPath = Storage::disk('business')->path($business_id."/logo/crop_".$Business->picture);
                }
            }
        }else{
            $logoPath = storage_path("app/qr-code/".$business_id."/".$file_name);
            $isLogoData = false;
        }

        if(!file_exists($logoPath)){
            $logoPath = public_path()."/img/jm_logo.png";
        }

        $_setting = null;
        $QRCodeSetting = QRCodeSetting::where("business_id", $business_id)->where("id", $setting_id)->first();
        if(!empty($QRCodeSetting) && $setting_change == 1){
            if($QRCodeSetting->out_eye !== null){
                $outEyeColor = $QRCodeSetting->out_eye;
            }

            if($QRCodeSetting->inner_eye !== null){
                $innerEyeColor = $QRCodeSetting->inner_eye;
            }

            if($QRCodeSetting->single !== null){
                $singleColor = $QRCodeSetting->single;
            }

            if($QRCodeSetting->logo_data !== null && Storage::exists("qr-code/".$business_id."/".$QRCodeSetting->logo_data)){
                $logoPath = storage_path("app/qr-code/".$business_id."/".$QRCodeSetting->logo_data);
                $file_name = $QRCodeSetting->logo_data;
                $isLogoData = false;
            }
        }

        $QRCode = new QRCode($qr_data, $logoPath, $isLogoData, $size, "FFFFFF", $singleColor, $outEyeColor, $innerEyeColor);

        if($file_name != ""){
            $_setting['logo_url'] = '/qr-code/' . $business_id.'/'.$file_name;
            $_setting['file_name'] = $file_name;
        }

        if(empty($backgroundColor)){
            $_setting['background'] = $QRCode->getBackgroundHex();
        }else{
            $_setting['background'] = $backgroundColor;
        }

        if(empty($singleColor)){
            $_setting['single'] = $QRCode->getSingleHex();
        }else{
            $_setting['single'] = $singleColor;
        }

        if(empty($outEyeColor)){
            $_setting['out_eye'] = $QRCode->getOutEyeHex();
        }else{
            $_setting['out_eye'] = $outEyeColor;
        }

        if(empty($innerEyeColor)){
            $_setting['inner_eye'] = $QRCode->getInnerEyeHex();
        }else{
            $_setting['inner_eye'] = $innerEyeColor;
        }

        $svg =  $QRCode->getRendererSvg();

        Storage::put("test.php", $svg);

        $data = array(
            "title_one" => $title_one,
            "title_two" => $title_two,
            "title_one_size" => $title_one_size,
            "title_two_size" => $title_two_size,
            "title_one_color" => "#".$title_one_color,
            "title_two_color" => "#".$title_two_color,

            "svg" => $svg,
        );
        //ini_set('memory_limit', '-1');
        //ini_set('backtrack_limit', '100000000');
        $pdf = MPDF::loadView('business.auth.qr_code_pdf', $data);

        $fileName = md5('qr-code-pdf' . $business_id.$location_id);
        $storage = 'qr-code/' . $business_id;
        $originalPdf = $fileName . '.pdf';
        Storage::put($storage . '/' . $originalPdf, $pdf->output());
//        ob_start();
//
//        echo $pdf->stream('gr-code-'.$location_id.'.pdf');
//
//        $contents = ob_get_contents();
//
//        ob_clean();

        //$dataUri = "data:application/pdf;base64," . base64_encode($contents);
        $dataUri = "/".$storage."/".$originalPdf;
        return response(['data' => ["pdf_data" => $dataUri, "setting" => $_setting]], 200);
    }

    public function getCropImage(Request $request){
        $business_id = $request->input('business_id', 0);
        $image_data = $request->input('image-data', "");
        $crop_data = $request->input('crop-data', "");
        ini_set('memory_limit', '-1');
        $imageCropData = \GuzzleHttp\json_decode($crop_data);
        $cropImage = Image::make($image_data)->orientate()->encode('png');

        $cropImage->crop((int)$imageCropData->width, (int)$imageCropData->height, (int)$imageCropData->x, (int)$imageCropData->y)->trim('black', array('top', 'bottom', 'left', 'right'));
        $cropImage->resize(1024, 1024);
        $fileName = md5('qr-code-temp' . $business_id);
        $storage = 'qr-code/' . $business_id;
        $originalImage = $fileName . '.png';
        Storage::put($storage . '/' . $originalImage, $cropImage->encode());

        $data["file_name"] = $originalImage;
        $data["url"] = '/'.$storage . '/' . $originalImage;

        return response(['data' => $data, "param" => $imageCropData], 200);
    }

    public function getSelectedLocationByBusiness(Request $request)
    {
        if (!auth()->user()) {
            return response(['error' => 'auth user error'], 500);
        }
        $language_prefix = $request->input('language_prefix', "en");
        //app()->setLocale($language_prefix);
        $keyword = $request->input('keywords', "");
        $business_id = $request->input('business_id', "");
        $page = 1;
        $page_current = $request->input('page', 0);

        if ($page_current > $page) {
            $page = $page_current;
        }

        $keywords = explode(' ', $keyword);
        $query = Location::select('business_locations.*');
        $query->where(function ($where) use ($keywords) {
            foreach ($keywords as $keyword) {
                $where->orWhere('business_locations.name', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.street', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.city', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.region', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.country', 'like', '%' . $keyword . '%');
                $where->orWhere('business_locations.street_number', 'like', '%' . $keyword . '%');
            }
        });
        $Business_ids = Business::query()->Where('id', $business_id)->orWhere('parent_id', $business_id)->get()->pluck("id")->toArray();
        $query->whereIn('business_id', $Business_ids)->orderBy('id', "asc");

        $UserManager = Administrator::where('business_id', $business_id)->where('user_id', auth()->user()->id)->first();
        if(!empty($UserManager) && $UserManager->role != Administrator::ADMIN_ROLE){
            $query = $query->join("business_manager_locations", "business_manager_locations.location_id", "=", "business_locations.id")
                ->where("business_manager_locations.administrator_id", $UserManager['id']);
        }

        $data['total_count'] = $query->count();
        $data['items'] = $query->with(['business'])->skip(25 * ($page - 1))->take(25 * $page)->get()->toArray();

        return response(['data' => $data], 200);
    }
}

