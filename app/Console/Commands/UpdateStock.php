<?php

namespace App\Console\Commands;

use App\Helpers\ArrayToCsvHelper;
use App\Models\TrenzProducts;
use App\Services\Plentymarket\SearchUpdatedVariationsService;
use App\Services\Plentymarket\UpdateShopVariationStockService;
use Illuminate\Console\Command;

class UpdateStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pm:updateVariationStock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SearchUpdatedVariationsService $searchUpdatedVariationsService,
                           UpdateShopVariationStockService $shopVariationStockService)
    {
        #Retrieve Trenz products
        $products = TrenzProducts::all()->toArray();
        #Compare the price and stock values of each PM variation with his image in Trenz
        $variations = $searchUpdatedVariationsService->checkStockUpdate($products);
        #run update in PM system
        $shopVariationStockService->runStockUpdate($variations);
        #store updated variation list in csv file to the report
        ArrayToCsvHelper::createCsvFileFromArray("price_update_report",$variations,false,";");

        return Command::SUCCESS;
    }
}
