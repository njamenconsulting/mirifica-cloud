<?php

namespace App\Console\Commands;

use App\Helpers\ArrayToCsvHelper;
use App\Models\TrenzProducts;
use App\Services\Plentymarket\SearchUpdatedVariationsService;
use App\Services\Plentymarket\UpdateShopVariationPriceService;
use Illuminate\Console\Command;

class UpdatePrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pmvariation:updateprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update links between variations and sales prices and save prices ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SearchUpdatedVariationsService $searchUpdatedVariationsService,
                           UpdateShopVariationPriceService $updateShopVariationPriceService)
    {
        #Retrieve Trenz products
        $products = TrenzProducts::all()->toArray();
        #Compare the price and stock values of each PM variation with his image in Trenz
        $variations = $searchUpdatedVariationsService->checkSalesPriceUpdate($products);

        #run update in PM system
        $variationAffected = $updateShopVariationPriceService->runSalePriceUpdate($variations);

        #store updated variation list in csv file to the report
        ArrayToCsvHelper::createCsvFileFromArray("price_update_report",$variations,false,";");

        return Command::SUCCESS;
    }
}
