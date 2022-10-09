<?php

namespace App\Services\Plentymarket;

use App\Helpers\ArrayToCsvHelper;
use App\Services\Api\CurlService;
use App\Services\Api\TokenService;

class UpdateShopVariationPriceService
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

    /**
     * Updating variation sales price data https://developers.plentymarkets.com/en-gb/developers/main/rest-api-guides/bulk-routes.html
     * @param array $variations
     * @return void
     */
    public function runSalePriceUpdate(Array $variations)
    {
        #This route allows you to update up to 50 links between variations and sales prices and save prices at the same time
        $url = $this->_url."/rest/items/variations/variation_sales_prices";

        $method = "PUT";

        $bulkIteration = ceil(count($variations)/50);

        for ($i=0; $i < $bulkIteration; $i++) {

            for ($j=0; $j < 50; $j++) {

                # price Gross calculation by adding VAT of 19%
                $priceGross = $variations[$j]['new_value'] + $variations[$j]['new_value']  * $this->_vat;

                $field = [
                    'variationId' => $variations[$j]['variationId'], #The ID of the variation
                    'salesPriceId' => 1, # $variations[$j]['salesPriceId'],The ID of the sales price
                    'price' => $priceGross #A new price for the sales price/variation combination
                ];
;
                $fields[0] = $field;
                if($j!=0) $fields[$j] = array_merge($fields[$j-1], $field);
            }

            $response = CurlService::makeHttpRequest($method, $url, $this-> _header,$fields);

            $responses[$i] = $response;
           // if(array_key_exists('success',$response)) ArrayToCsvHelper::createCsvFileFromArray("price_update_report",$fields,false,";");
        }
       // dd($responses);

    }

}
