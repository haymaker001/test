<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCenterRequest;
use App\Http\Requests\UpdateCenterRequest;

use Illuminate\Support\Facades\Gate;

class FleetioController extends Controller
{
    const ACCOUNT_TOKEN = '989e68e8a5';
    const BASE_URL1 = 'https://secure.fleetio.com/api/v1/';
    const BASE_URL2 = 'https://secure.fleetio.com/api/v2/';
    const API_TOKEN = '24a26c9c54e9d382e3bd8c1afdd0886b6c410f5f';

    public function getDataFromFleetio($endpoint)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token ' . self::API_TOKEN,
                'Account-Token' => self::ACCOUNT_TOKEN,
                'Accept' => 'application/json',
            ])->get(self::BASE_URL2 . '/' . $endpoint);

            return $data = $response->json();
            
        } catch (\Exception $e) {
            
            dd($e->getMessage());
        }
    }
    
    function get_service_reminders()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::BASE_URL2 . 'service_reminders',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Token ' . self::API_TOKEN,
                'Account-Token: ' . self::ACCOUNT_TOKEN,
            ),
        ));
        
        $response = curl_exec($curl);
        
        if (curl_errno($curl)) {
            curl_close($curl);
            return json_encode(['error' => 'Error en la solicitud cURL: ' . curl_error($curl)]);
        }
        curl_close($curl);
        
        $decodedResponse = json_decode($response, true);
        
        return $decodedResponse;
    }
    
    function get_vehicles()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::BASE_URL1 . 'vehicles',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Token ' . self::API_TOKEN,
                'Account-Token: ' . self::ACCOUNT_TOKEN,
            ),
        ));
        
        $response = curl_exec($curl);
        
        if (curl_errno($curl)) {
            curl_close($curl);
            return json_encode(['error' => 'Error en la solicitud cURL: ' . curl_error($curl)]);
        }
        curl_close($curl);
        
        $decodedResponse = json_decode($response, true);
        
        return $decodedResponse;
    }
}