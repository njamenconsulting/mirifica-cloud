<?php

namespace App\Console\Commands;

use App\Models\PmVariations;
use App\Services\Plentymarket\SearchUpdatedVariationsService;
use App\Services\Plentymarket\PmApiService;
use Illuminate\Console\Command;

class GetPmVariations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pmvariation:getdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists variations including the specified related data.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(PmVariations $pmvariationModel, PmApiService $pmApiService, SearchUpdatedVariationsService $checkUpdateService)
    {
        $variations = $pmApiService->getAllVariations();
     
        $result = $pmvariationModel->upsert($variations,['variationId'],['itemId','externalId','salesPriceId','price','stock']);

        return Command::SUCCESS;
    }
}
