<?php

namespace App\Services\Element14;

use App\Services\Api\CurlService;

Class Element14ApiService
{
    const BASE_URL = 'https://api.element14.com/catalog/products';

    private $_curlService;
    //
    public function __construct()
    {
        $this->_curlService = new CurlService();
    }
    //Returns Product information based on a search by keyword
    public function keywordSearch($array)
    {
 
        $query = "versionNumber=1.2&term=any:".$array['keyword']."&storeInfo.id=".$array['storeInfo']."&resultsSettings.offset=".$array['startingOffset']."&resultsSettings.numberOfResults=".$array['numberOfResults']."&resultsSettings.refinements.filters=".$array['filters']."&resultsSettings.responseGroup=".$array['responseGroup']."&callInfo.responseDataFormat=JSON&callinfo.apiKey=ds7jb83h2q2hdteqbq5f9fra";
        $url = self::BASE_URL."?".$query;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));


        if(curl_exec($curl) === false) 
            return 'Erreur Curl : ' . curl_error($curl);
        else $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }
    //
    public function searchByManufacturerPartNumber()
    {
        //
    }
}