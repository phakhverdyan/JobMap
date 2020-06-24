<?php

namespace App\Http;
use App\Business\Administrator;
use App\GraphQL\Extensions\AuthQuery;
use Illuminate\Support\Facades\Cookie;

/**
 * Class GraphQLClient
 * @package App\Http
 */
class GraphQLClient
{
    protected $requestData = [];
    protected $responseData = [];
    protected $typeQuery;
    protected $query;

    protected $jsonData;

    /**
     * @param $query
     * @param string $typeQuery
     */
    public function setParams($query, $typeQuery = "query")
    {
        $this->typeQuery = $typeQuery;
        $this->query = $query;
    }

    public function addResponse($response)
    {
        if ($response && is_array($response) && count($response) > 0) {
            $this->responseData = array_merge($this->responseData, $response);
        }
    }

    public function addRequest($request)
    {
        if ($request && is_array($request) && count($request) > 0) {
            $this->requestData = array_merge($this->requestData, $request);
        }

        if ($request && is_string($request)) {
            $this->requestData[] = $request;
        }
    }

    protected function setJSON()
    {
        $request = '';

        if (count($this->requestData) > 0) {
            $request .= '(';

            foreach ($this->requestData as $key => $value) {
                $request .= $key . ': ' . json_encode($value) . ', ';
            }

            $request = rtrim($request, ', ');
            $request .= ')';
        }

        $response = implode(',', $this->responseData);

        $postData = [
            'query' => $this->typeQuery . '{' . $this->query . $request . '{' . $response . '}}'
        ];

        $this->jsonData = json_encode($postData);
        return $this->jsonData;
    }

    public function request()
    {
        $this->setJSON();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, config('app.url') . '/graphql');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $this->jsonData);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $headers = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($this->jsonData),
        ];

        if (isset($_COOKIE['api-token']) && $_COOKIE['api-token']) {
            $headers[] = 'Authorization: Bearer ' . $_COOKIE['api-token'];
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($curl);
        
        $data = json_decode($response);

        if (isset($data->errors) && $data->errors) {
            throw new \Exception(
                'GraphQLClient Error: ' . $this->typeQuery . ' `' . $this->query . '`: ' .
                $data->errors[0]->message .
                ' [' . $data->errors[0]->locations[0]->line . ' :' . $data->errors[0]->locations[0]->column . ']'
            );
        }

        if (!$data || !$data->data || !property_exists($data->data, $this->query)) {
            throw new \Exception(
                // 'GraphQLClient Error: Invalid response: ' . $response
                'GraphQLClient Error: ' . $this->typeQuery . ' `' . $this->query . '`: Invalid response: ' . $response
            );
        }

        return $data->data->{$this->query};
    }

    public static function isPermitAdministrator($permit)
    {
        $businessID = Cookie::get('business-id');

        if (! $businessID) {
            return false;
        }

        $auth = new AuthQuery();
        $auth->authorize([],[]);

        try {
            if ($auth->checkBusinessAccess($businessID,[ Administrator::MANAGER_ROLE, Administrator::FRANCHISE_ROLE ], $permit)) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }

    public static function isAdministrator()
    {
        $businessID = Cookie::get('business-id');

        if (! $businessID) {
            return false;
        }

        $auth = new AuthQuery();
        $auth->authorize([],[]);

        return $auth->checkIsAdmin($businessID);
    }

}
