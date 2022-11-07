<?php

namespace App\Helpers;

/**
 * MepaMouserDataHelper 
 */
class MepaMouserDataHelper
{    
    /**
     * This function allows to extract mepa data from results returned 
     *
     * @param  array $data
     * @return array $mepaData
     */
    public static function extractedDataForMepa($data)
    {

        foreach($data as $key => $value) {
           
            if (!array_key_exists("Availability", $value)) $value["Availability"] = "NaN";
            if (!array_key_exists("Description", $value)) $value["Description"] = "NaN";
            if (!array_key_exists("ImagePath", $value)) $value["ImagePath"] = "NaN";
            if (!array_key_exists("Manufacturer", $value)) $value["Manufacturer"] = "NaN";
            if (!array_key_exists("ManufacturerPartNumber", $value)) $value["ManufacturerPartNumber"] = "NaN";
            if (!array_key_exists("MouserPartNumber", $value)) $value["MouserPartNumber"] = "NaN";
            if (!array_key_exists("PriceBreaks", $value)) $value["PriceBreaks"] = "NaN";
            if (!array_key_exists("ProductDetailUrl", $value)) $value["ProductDetailUrl"] = "NaN";
            if (!array_key_exists("MouserProductCategory", $value)) $value["MouserProductCategory"] = "NaN";
            #I the case where PriceBreaks in not an array 
            if(count($value["PriceBreaks"])>1) $value["PriceBreaks"] = $value["PriceBreaks"][0]["Price"] ;
            else $value["PriceBreaks"] = "NaN" ;

            $mepaData[$key] = [ 
                            "Availability" =>preg_replace("/[^0-9]/","",$value["Availability"]),
                            "Description" =>$value["Description"],
                            "ImagePath"=>$value["ImagePath"],
                            "Manufacturer"=>$value["Manufacturer"],
                            "ManufacturerPartNumber"=>$value["ManufacturerPartNumber"],
                            "MouserPartNumber"=>$value["MouserPartNumber"],
                            "PriceBreaks"=>$value["PriceBreaks"],
                            "ProductDetailUrl"=>$value["ProductDetailUrl"],
                            "MouserProductCategory"=>$value["MouserProductCategory"],
                        ] ;
        }

        return $mepaData;
    }
}