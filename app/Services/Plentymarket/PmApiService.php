<?php

namespace App\Services\Plentymarket;
use App\Services\Api\TokenService;
use App\Services\Api\CurlService;


class PmApiService
{
    private $_url;
    private $_vat;
    private $_header;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        $this->_url = config('plentymarket.BASE_URL');

        $this->_vat = config('plentymarket.VAT');

        $this->_header =  [
            'Content-Type: application/json;charset=utf-8',
            'Authorization: Bearer '.(new TokenService())->getAccessToken()
        ];
    }
    public function getAllVariations():array
    {
        //https://developers.plentymarkets.com/en-gb/plentymarkets-rest-api/index.html#/Pim/get_rest_pim_variations_scroll
        $cursor=null;  //The cursor to get the next entries
        $i=0;
        do
        {
            $method = "GET";
            $url = $this->_url."/rest/pim/variations/scroll?cursor=".$cursor;
            $params =[
                'with' => 'base.stock,salesPrice,salesPrices.salesPrice,categories',
                'anyCategoryId' => '29,30',
            ];
            $response = CurlService::makeHttpRequest($method, $url,$this-> _header, $params);

            if($i == 0) $variations = $response['entries'];
            else $variations = array_merge($variations, $response['entries']);

            $cursor = $response['cursor'] ;
            $i++;

        }while(!is_null($cursor));

       // $url = $this->_url."/rest/pim/variations?=_with=base.stock,salesPrices,categories&anyCategoryId=29,30&itemsPerPage=250&page=".$page;

        foreach ($variations as $key => $value) {

            $data[$key] = [
                                'itemId' => $value['base']['itemId'],
                                'variationId' => $value['id'],
                                'externalId' => (int)$value['base']['externalId'],
                                'salesPriceId' => (int)$value['salesPrices'][0]['salesPriceId'],
                                'price' => $value['salesPrices'][0]['price'],
                                'stock' => $value['base']['stock'][0]['stockPhysical'],
                                // 'stock2'=> $value['base']['stock'][1]['stockPhysical']
                            ];
        }
        return $data;
    }

}
