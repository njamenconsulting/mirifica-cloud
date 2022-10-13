<?php

namespace App\Console\Commands;

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

        $products = TrenzProducts::all();
        $variations = $searchUpdatedVariationsService->checkStockUpdate($products);
        $shopVariationStockService->runStockUpdate($variations);

        return Command::SUCCESS;
    }
}
