<?php

namespace App\Helpers;

class MepaDataElement14Helper
{
    const BASE_URL = 'https://api.element14.com/catalog/products';

    public static function extratedDataForMepa($array)
    {

        for ($i=0; $i < count($array); $i++) { 

            if (!array_key_exists("sku", $array[$i])) $array[$i]['sku'] = "NaN";
            if (!array_key_exists("displayName", $array[$i])) $array[$i]['displayName'] = "NaN";
            if (!array_key_exists("productStatus", $array[$i])) $array[$i]['productStatus'] = "NaN";
            if (!array_key_exists("drohsStatusCode", $array[$i])) $array[$i]['rohsStatusCode'] = "NaN";
            if (!array_key_exists("packSize", $array[$i])) $array[$i]['packSize'] = "NaN";
            if (!array_key_exists("unitOfMeasure", $array[$i])) $array[$i]['unitOfMeasure'] = "NaN";
            if (!array_key_exists("id", $array[$i])) $array[$i]['id'] = "NaN";

            if (!array_key_exists("image", $array[$i])) $array[$i]['image']['baseName'] = "NaN";

            if (!array_key_exists("prices", $array[$i])) $array[$i]['prices'] = "NaN";
            if (!array_key_exists("inv", $array[$i])) $array[$i]['inv'] = "NaN";
            if (!array_key_exists("vendorId", $array[$i])) $array[$i]['vendorId'] = "NaN";
            if (!array_key_exists("vendorName", $array[$i])) $array[$i]['vendorName'] = "NaN";
            if (!array_key_exists("translatedManufacturerPartNumber", $array[$i])) $array[$i]['translatedManufacturerPartNumber'] = "NaN";

            $data[$i] = array(  'sku' => $array[$i]['sku'],
                                'displayName' => $array[$i]['displayName'] ,
                                'productStatus' => $array[$i]['productStatus'] ,
                                'rohsStatusCod' => $array[$i]['rohsStatusCode'] ,
                                'packSize' => $array[$i]['packSize'] ,
                                'unitOfMeasure' => $array[$i]['unitOfMeasure'] ,
                                'id' => $array[$i]['id'] ,
                                'productImage' => self::BASE_URL.$array[$i]['image']['baseName'] ,
                                'prices' => $array[$i]['prices'][0]['cost'] ,
                                'inv' => $array[$i]['inv'],
                                'vendorId' => $array[$i]['vendorId'],
                                'vendorName' => $array[$i]['vendorName'],
                                'translatedManufacturerPartNumber' => $array[$i]['translatedManufacturerPartNumber']
                            );                       
        }

        return $data;
    }

    
        
/*
 - Manufacturer article code / manufacturer part number
- Commercial name / Name of the item
- Price			
- Supplier article code / like Mouser part number or Digikey part number
- Image	
- Computer board brand / the name of the manufacturer
*/

}