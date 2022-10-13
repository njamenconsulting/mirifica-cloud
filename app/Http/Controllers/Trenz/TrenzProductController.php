<?php

namespace App\Http\Controllers\Trenz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Trenz\TrenzApiService;
use App\Models\TrenzProducts;

class TrenzProductController extends Controller
{
    private $_trenzApiService;
    private $_productModel;

    public function __construct(TrenzApiService $trenzApiService,TrenzProducts $productModel)
    {
        $this-> _trenzApiService = $trenzApiService;
        $this-> _productModel = $productModel;
    }
    public function index()
    {
        //retrieve all product in trenz_product table
        //and return them in view  no such flight exists,
    }
    public function updateOrInsert()
    {
        /* Retrieving all Trenz articles filtered by active or not*/

        $response = $this-> _trenzApiService->getAllArticles(1);
dd($response);
        if(!$response['success']) echo "Request error";

        $products = $response['data'];

        foreach ($products as $key => $product){

            # The returned info does not contain the price attribute
            $response = $this-> _trenzApiService->getArticleById($product['id']);
            $productPrice = $response['data']['mainDetail']['prices'][0]['price'];

            $data[$key] = array(
                                    'productId' =>$product['id'],
                                    'price' =>$productPrice,
                                    'stock' =>$product['mainDetail']['inStock'],
                                    'name' =>$product['name'],
                                    'description' =>$product['description']
                                );
            $result[$key]  = $this-> _productModel->creatUp($data[$key]);
        }
        #store into db

        dd($result);
    }

    public function delete()
    {
        //
    }
}
