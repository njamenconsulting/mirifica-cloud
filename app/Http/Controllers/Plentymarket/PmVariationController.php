<?php

namespace App\Http\Controllers\Plentymarket;

use App\Http\Controllers\Controller;
use App\Services\Report\UpdateReportService;
use Illuminate\Http\Request;
use App\Services\Plentymarket\PmApiService;
use App\Models\PmVariations;
use App\Models\TrenzProducts;
use App\Models\ProductNotOffered;

class PmVariationController extends Controller
{
    private $_pmApiService;
    private $_pmvariationModel;
    private $_trenzProductModel;
    private $_productNotOfferedModel ;
    private $_updateReportService;

    public function __construct(PmApiService $pmApiService,
                                PmVariations $pmvariationModel,
                                TrenzProducts $trenzProductModel,
                                ProductNotOffered $productNotOfferedModel,
                                UpdateReportService $updateReportService)
    {
        $this->_pmApiService = $pmApiService;
        $this->_pmvariationModel= $pmvariationModel;
        $this->_trenzProductModel = $trenzProductModel;
        $this->_productNotOfferedModel = $productNotOfferedModel;
        $this->_updateReportService = $updateReportService;
    }
    public function create()
    {
        $start_time=microtime(true);

        $response = $pmApiService->getAllVariations();

        foreach ($response as $key => $value)
        {
            $variations[$key] = [
                'itemId'=> $value['base']['itemId'],
                'variationId'=> $value['id'],
                'externalId'=>(int)$value['base']['externalId'],
                'salesPriceId'=>(int)$value['salesPrices'][0]['salesPriceId'],
                'price'=> $value['salesPrices'][0]['price'],
                'stock'=> $value['base']['stock'][0]['stockPhysical'],
               // 'stock2'=> $value['base']['stock'][1]['stockPhysical']
            ];

            $result[$key] = $pmvariationModel->upsert($variations[$key],['variationId'],['itemId','externalId','salesPriceId','price','stock']);
        }

        $end_time=microtime(true);

        echo "time: ". bcsub($end_time, $start_time, 4) ."\n";
        echo "memory (byte): ". memory_get_peak_usage(true) ."\n";
        dd($result);
    }

    public function update()
    {

        $trenzProducts = $this->_trenzProductModel::all();
        $i=0;$j=0;

        foreach ($trenzProducts as $key => $product) {

            $result = $this->_pmvariationModel->where('externalId', $product->productId)->get()->toArray();

            if (count($result)>0) {
                $variation = $result[0];
                echo "dddd".$i++;
                #If the price is different, then we shall do update
                if($variation['price'] != $product->price) {

                    $queryPrice = $this->_pmvariationModel->where('externalId', $product->productId)
                                                          ->update(['price' => $product->price]);

                    #If the updating it's ok, we store date into report table
                    if($queryPrice) $this->_updateReportService->create("price",$variation, $product);
                    else die("The price updating runned bad");#
                }
                #If the stock is different, then we shall do update
                if($variation['stock']!=$product->stock){
                    $queryStock = $this->_pmvariationModel->where('externalId', $product->productId)
                        ->update(['stock' => $product->stock]);

                    #If the updating it's ok, we store date into report table
                    if($queryStock) $this->_updateReportService->create("stock",$variation, $product);
                    else dd("The stock updating runned bad");
                }
            }
            #if the product no found in PM db, case of no sell product in webstore
            else {
                $report = [
                    'productId'=> $product->productId,
                    'price'=> $product->price,
                    'stock'=> $product->stock,
                    'name'=> $product->name,
                    'description'=> $product->description,
                ];

                $this->_productNotOfferedModel->create($report);
            }

        }
    }
    public function delete()
    {
        //
    }
}
