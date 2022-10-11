<?php

namespace App\Services\Plentymarket;

use App\Helpers\ArrayToCsvHelper;
use App\Services\Api\CurlService;
use App\Services\Api\TokenService;

/**
 * This class allow to update stock linking to variation
 */
class UpdateShopVariationStockService
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
     * https://developers.plentymarkets.com/en-gb/plentymarkets-rest-api/index.html#/StockManagement/put_rest_stockmanagement_warehouses__warehouseId__stock_correction
     * @param array $variations
     * @return mixed
     */
    public function runStockUpdate(Array $variations)
    {
        $url = $this->_url."/rest/stockmanagement/warehouses/1/stock/correction";

        $method = "PUT";

        $fields =array();

        $bulkIteration = ceil(count($variations)/50);

        for ($i=0; $i < $bulkIteration; $i++) {

            for ($j=0; $j < 50; $j++) {

                $field = [
                    'variationId'=> $variations[$j]['variationId'], #The ID of the variation
                    'reasonId' => 301, #The reason for correction. The following reasons are available:301: Stock correction
                    'quantityj' => (int)$variations[$j]['new_value'], #The quantity of the variation
                    'storageLocationId' => 0 #The ID of the storage location
                ];

                $fields[0] = $field;
                if($j!=0) $fields[$j] = array_merge($fields[$j-1], $field);
            }

            $fields = ["corrections" => $fields];

            $response = CurlService::makeHttpRequest($method, $url,$this-> _header,$fields);

            //if($response) ArrayToCsvHelper::createCsvFileFromArray("stock_update_report",$fields['corrections'],false,";");
        }

    }
}
