<?php

namespace App\Services\Trenz;
use App\Services\Api\CurlService;

class TrenzApiService
{
    const BASE_URL ="https://shop.trenz-electronic.de/api/";
    private $_header;

    public function __construct(){

        $this-> _header =  ['Content-Type: application/json;charset=utf-8',
            'Authorization: Basic bWlyaWZpY2EtYXBpOnAwcGRzQ3FHV1FEblJlRXk4NUtuSzh5Q0NBd1JRcEVobjZuTlNDb20='
        ];
    }
    /* Retrieving all Trenz products filtered by active or not
      in the where API call returns more than 1000 products,We shall use a loop to get all product in using the offset

    */
    public function getAllArticles($offset):array
    {

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

        $articles = CurlService::makeHttpRequest($method, $url,$this-> _header,$fields);

        return $articles;
    }
    //
    public function getArticleById($articleId)
    {

        $method = "GET";

        $url = self::BASE_URL."articles/".$articleId."?language=2";

        $article = CurlService::makeHttpRequest($method, $url,$this-> _header,[]);

        return $article;
    }
}
