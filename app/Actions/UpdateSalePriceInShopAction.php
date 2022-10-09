<?php

namespace App\Actions;
use App\Models\UpdateReport;
use App\Services\Plentymarket\PmApiService;

class UpdateSalePriceInShopAction
{
    private $_pmApiService;
    private $_updateReportModel;

    public function __construct(PmApiService $pmApiService, UpdateReport $updateReport)
    {
        $this->_pmApiService = $pmApiService;
        $this->_updateReportModel = $updateReport;
    }

    public function update()
    {
        $variations = $this->_updateReportModel::all();
        dd($variations);
    }

}
