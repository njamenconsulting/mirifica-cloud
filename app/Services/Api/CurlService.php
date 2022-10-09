<?php

namespace App\Services\Api;

class CurlService
{
    public static function makeHttpRequest($method, $url,$header,$data)
    {

        $curl = curl_init();//Initialize the cURL session
        //https://curl.se/docs/caextract.html
        $certificate_path = public_path('certs/cacert.pem');

        curl_setopt($curl, CURLOPT_URL, $url);
        #Set RETURNTRANSFER option to true to return the transfer as a string instead of outputting it directly
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 300);
        curl_setopt($curl, CURLOPT_CAINFO, $certificate_path);
        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);//This option tells cURL that it must verify the host name in the server cert
        //curl_setopt($curl, CURLOPT_VERIFYPEER, 0); //This option tells cURL to verify the authenticity of the SSL cert on the server.
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        #For posting fields as an array by cURL
        curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($data));
        #/If you want to include the header in the output set CURLOPT_HEADER to true
        curl_setopt($curl, CURLOPT_HEADER, false);
        #if your request has headers like bearer token or defining JSON contents you have to set
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($curl);

        $err = curl_error($curl);

        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $http_code = curl_getinfo($curl, CURLINFO_REDIRECT_TIME);#La durée exprimée en seconde de l'ensemble des étapes de redirection avant l'accès à la ressource finale soit commencée
        $http_code = curl_getinfo($curl, CURLINFO_TOTAL_TIME_T); #le temps total d'éxécution de la transaction en microseconde.

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }
        else {
            if($response===false) return ["Bad request"];

            else return json_decode($response,true);
        }
    }
}
