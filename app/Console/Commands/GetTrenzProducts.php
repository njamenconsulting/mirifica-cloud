<?php

namespace App\Console\Commands;

use App\Models\TrenzProducts;
use App\Services\Trenz\TrenzApiService;
use Illuminate\Console\Command;

class GetTrenzProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trenzproducts:getlist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a product list from Trenz API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(TrenzApiService $trenzApiService, TrenzProducts $productModel)
    {
        /* Retrieving all Trenz articles filtered by active or not*/
        $products = $trenzApiService->getAllArticles();

        $productModel->creatUp($products);
        return Command::SUCCESS;
    }
}
