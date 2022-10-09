<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Cache;

class TokenService
{
    /**
     * _header
     *
     * @var mixed
     */
    private $_header;
    /**
     * _username
     *
     * @var mixed
     */
    private $_username;
    /**
     * password
     *
     * @var mixed
     */
    private $_password;

    private $_url;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->_header =  ['Content-Type: application/json;charset=utf-8'];
        $this->_url = config('plentymarket.BASE_URL');
        $this->_username = config('plentymarket.USERNAME');
        $this->_password = config('plentymarket.PASSWORD');
    }
    /**
     *  Retrieve access_token value from the cache or, if access token has expired
     *  request a new access token and add them to the cache
     *
     *  Return access_token whith valid expire_in value
     *
     * @return string
     */
    public function getAccessToken()
    {
        if (Cache::has('access_token')) {
            //Retrieve and return access_token value from caching
            return Cache::get('access_token');

        }
        else{
            $token = $this->requestTokenFromAuthServer();
            $this->storeTokenInCache($token);
            return Cache::get('access_token');
        }

    }

    /**
     * requestTokenFromAuthServer
     *
     * @return array
     */
    private function  requestTokenFromAuthServer():array
    {
        $url = $this->_url."/rest/login";
        $postfield = ['username' => $this->_username,'password' => $this->_password];
        $method ="POST";
        $response = CurlService::makeHttpRequest($method, $url,$this-> _header,$postfield);

        return $response;
    }
    /**
     * storeTokenInCache Allow to Use put method on the Cache facade to store  parameters to the entity-body of the HTTP response in the cache
     *
     * @param  array $data which contains HTTP response issued by PM Authorization Server
     * @return boolean
     */
    private function storeTokenInCache($data = array()):bool
    {
        $minutes = $data['expires_in']/60;

        return Cache::put('access_token', $data['access_token'], now()->addMinutes($minutes));
        //Cache::put('token', $data['access_token'],$data['expires_in']);
    }

}
