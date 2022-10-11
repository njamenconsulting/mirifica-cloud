<?php

namespace App\Http\Controllers\Plentymarket;

use App\Http\Controllers\Controller;
use App\Models\UpdateReport;
use App\Services\Plentymarket\PmApiService;
use App\Services\Plentymarket\UpdateShopVariationPriceService;
use App\Services\Plentymarket\UpdateShopVariationStockService;
use Illuminate\Http\Request;

class PmShopController extends Controller
{

    private $_updateReportModel;
    private $_updateShopVariationPriceService;
    private $_updateShopVariationStockService;

    public function __construct(
                                UpdateReport                    $updateReport,
                                UpdateShopVariationPriceService $updateShopVariationPriceService,
                                UpdateShopVariationStockService $updateShopVariationStockService)
    {
        $this->_updateReportModel = $updateReport;
        $this->_updateShopVariationPriceService = $updateShopVariationPriceService;
        $this->_updateShopVariationStockService = $updateShopVariationStockService;
    }
    public function updateSalesPrice()
    {
        $variations = $this->_updateReportModel->where('fieldname','price')->get()->toArray();
        $this->_updateShopVariationPriceService->runSalePriceUpdate($variations);

        $this->_updateShopVariationPriceService->where('fieldname','price')->delete();

    }
    public function updateStock()
    {
        $results = $this->_updateReportModel->where('fieldname','stock')->get()->toArray();
        $this->_updateShopVariationStockService->runStockUpdate($results);

        $this->_updateShopVariationPriceService->where('fieldname','stock')->delete();
    }
}
