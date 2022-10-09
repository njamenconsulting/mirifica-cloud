<?php

namespace App\Services\Report;
use App\Models\UpdateReport;

class UpdateReportService
{
    private $_reportModel;
    public function __construct(UpdateReport $reportModel)
    {
        $this->_reportModel = $reportModel;
    }

    public function create($fieldname,$variation, $product)
    {
        if($fieldname==='stock'){
            $oldValue = $variation['stock'];
            $newValue = $product->stock;
        }
        else{
            $oldValue = $variation['price'];
            $newValue = $product->price;
        }
        $data = [
            'fieldname' => $fieldname,
            'itemId' => $variation['itemId'],
            'variationId' => $variation['variationId'],
            'externalId'=> $variation['externalId'],
            'salesPriceId'=>$variation['salesPriceId'],
            'old_value' => $oldValue,
            'new_value' => $newValue,
        ];

        $this->_reportModel::create($data);

        return $data;

    }

}
