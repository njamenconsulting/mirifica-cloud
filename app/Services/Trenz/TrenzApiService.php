<?php

namespace App\Services\Trenz;

use App\Services\Api\CurlService;

class TrenzApiService
{
    const BASE_URL ="https://shop.trenz-electronic.de/api/";
    private $_header;

    public function __construct()
    {
         $this-> _header =  ['Content-Type: application/json;charset=utf-8',
            'Authorization: Basic bWlyaWZpY2EtYXBpOnAwcGRzQ3FHV1FEblJlRXk4NUtuSzh5Q0NBd1JRcEVobjZuTlNDb20='
        ];
    }
    /* Retrieving all Trenz products filtered by active or not
      in the where API call returns more than 1000 products,We shall use a loop to get all product in using the offset

    */
    /**
     * https://developers.shopware.com/developers-guide/rest-api/examples/article/
     * Allow to obtain information about a product list
     * @return array|void
     */
    public function getAllArticles()
    {
        $offset =1;
        $method = "GET";

        $url = self::BASE_URL."articles?start=".$offset."&language=2";

        $fields = [
            "filter" => [
                    [
                        "property" => "active",
                        "value"=> 1
                    ]
            ]
        ];

        $response = CurlService::makeHttpRequest($method, $url,$this-> _header,$fields);

        if($response['success'])
        {

            $product = $response['data'];
            for($i=0; $i<count($product); $i++)
            {

                $response = $this->getArticleById($product[$i]['id']);
                $productPrice = $response['data']['mainDetail']['prices'][0]['price'];
                $data[$i] = array(
                    'productId' =>$product[$i]['id'],
                    'price' =>$productPrice,
                    'stock' =>$product[$i]['mainDetail']['inStock'],
                    'name' =>$product[$i]['name'],
                    'description' =>$product[$i]['description']
                );
            }
            // Now let us obtain price of product, by using either its ID or product number
/*
            foreach ($products as $key => $product){
                # The returned info does not contain the price attribute
                $response = $this->getArticleById($product['id']);
                $productPrice = $response['data']['mainDetail']['prices'][0]['price'];
                $data[$key] = array(
                    'productId' =>$product['id'],
                    'price' =>$productPrice,
                    'stock' =>$product['mainDetail']['inStock'],
                    'name' =>$product['name'],
                    'description' =>$product['description']
                );

            }
*/

            return $data;
        }
        else echo "THERE ARE NO PRODUCT RETURNED";

    }

    /**
     * https://developers.shopware.com/developers-guide/rest-api/examples/article/
     * Allow to obtain information about a single product, by using either its ID number
     * @param $articleId
     * @return array
     */
    public function getArticleById($articleId):array
    {

        $method = "GET";

        $url = self::BASE_URL."articles/".$articleId."?language=2";

        $article = CurlService::makeHttpRequest($method, $url,$this-> _header,[]);

        return $article;
    }
}
