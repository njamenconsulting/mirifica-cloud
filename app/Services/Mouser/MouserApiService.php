<?php

namespace App\Services\Mouser;

use App\Services\Api\CurlService;

Class MouserApiService
{
    const BASE_URL ="https://api.mouser.com/api/";
    
    /**
     * _curlService
     *
     * @var mixed
     */
    private $_curlService;   
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        //$this->_url = config('plentymarket.BASE_URL');

        //$this->_vat = config('plentymarket.VAT');
    }  
    /**
     * getPartsByKeyword
     *
     * @param  mixed $array
     * @return json string 
     */
    public function getPartsByKeyword($array)
    {
        //on recupère (couper) le dernier element du tableau 
        $version = array_pop($array);

        $data['SearchByKeywordRequest'] = $array;

        $method = "POST";

        $url = 'https://api.mouser.com/api/'.$version.'/search/keyword?apiKey=a76659c5-f632-4836-bf84-8b8c507dcc70';


        $fields = $data;

        $header = array('Content-Type: application/json');

    //    $response = CurlService::makeHttpRequest($method, $url,$header,$fields);

        //Initialize the cURL session
        $ch = curl_init($url);
        //if your request has headers like bearer token or defining JSON contents you have to set
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //If you want to include the header in the output set CURLOPT_HEADER to true
        curl_setopt($ch, CURLOPT_HEADER, false);
        //Set RETURNTRANSFER option to true to return the transfer as a string instead of outputting it directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        /*To check the existence of a common name in the SSL peer certificate can be set to
        0(to not check the names), 1(not supported in cURL 7.28.1), 2(default value and for production mode)*/
     

        //For posting fields as an array by cURL
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        //Execute cURL and return the string. depending on your resource this returns output like
        if(curl_exec($ch) === false) 
           return 'Erreur Curl : ' . curl_error($ch);
        else $result = curl_exec($ch);
      
        //Close cURL resource, and free up system resources
        curl_close($ch);

        return $result;

    }
    //
    public function getmanufacturerlist()
    {
        $url = "https://api.mouser.com/api/v2/search/manufacturerlist?apiKey=a76659c5-f632-4836-bf84-8b8c507dcc70";
        return $this->_curlService->getRequest($url);
    }
}