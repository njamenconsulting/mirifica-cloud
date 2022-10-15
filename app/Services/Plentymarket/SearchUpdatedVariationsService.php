<?php

namespace App\Services\Plentymarket;

use App\Models\TrenzProducts;
use App\Models\PmVariations;

class SearchUpdatedVariationsService
{
    private TrenzProducts $_trenzProductModel;
    private PmVariations $_pmvariationModel;

    public function __construct(PmVariations $pmVariationsModel,TrenzProducts $trenzProductModel)
    {
        $this->_trenzProductModel = $trenzProductModel;
        $this->_pmvariationModel = $pmVariationsModel;
    }

    public function checkSalesPriceUpdate($data):array
    {
        $j=0;
        $variations = array();

        foreach ($data as $key => $product){

            $result = $this->_pmvariationModel->where('externalId', $product['productId'])->get()->toArray();

            if (count($result)>0) {
                $variation = $result[0];

                #If the price is different, then we shall do update
                if($variation['price'] != $product['price']) {
/*
                    try {
                        $this->_pmvariationModel->where('externalId', $product['productId'])
                                                              ->update(['price' => $product['price']]);
                    }
                    catch (\Exception $exception){
                        echo $exception->getMessage();
                    }
*/
                    $variations[$j] = [
                                        'fieldname' =>'price',
                                        'itemId' => $variation['itemId'],
                                        'variationId' => $variation['variationId'],
                                        'externalId'=> $variation['externalId'],
                                        'salesPriceId'=>$variation['salesPriceId'],
                                        'old_value' => $variation['price'],
                                        'new_value' => $product['price']
                                    ];
                    $j++;
                }
            }
        }

        return $variations;
    }

    /**
     * @param $data
     * @return array
     */
    public function checkStockUpdate($data):array
    {

        $variations = array();
        $j =0;
        for($i = 0; $i< count($data); $i++){

            $result = $this->_pmvariationModel->where('externalId', $data[$i]['productId'])->get()->toArray();

            if (count($result)>0) {
                $variation = $result[0];

                #If the stock is different, then we shall do update
                if($variation['stock']!=$data[$i]['stock']) {
/*
                    try {
                        $this->_pmvariationModel->where('externalId', $data[$i]['productId'])
                                                              ->update(['stock' => $data[$i]['stock']]);
                    }
                    catch (\Exception $exception){
                        echo $exception;
                    }
*/
                    $variations[$j] = [
                                        'fieldname' =>'stock',
                                        'itemId' => $variation['itemId'],
                                        'variationId' => $variation['variationId'],
                                        'externalId'=> $variation['externalId'],
                                        'salesPriceId'=>$variation['salesPriceId'],
                                        'old_value' => $variation['stock'],
                                        'new_value' => $data[$i]['stock'],
                                    ];
                    $j++;
                }
            }
        }
        return $variations;
    }

}
