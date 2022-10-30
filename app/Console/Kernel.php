<?php

namespace App\Console;

use App\Http\Controllers\Plentymarket\PmShopController;
use App\Http\Controllers\Plentymarket\PmVariationController;
use App\Http\Controllers\Trenz\TrenzProductController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        //trenzproducts:getlist
        //pmvariation:getdata
        //pmvariation:updatestock
        //pmvariation:updateprice
        $schedule->call(function () {
            Artisan::call("trenzproducts:getlist");
            Artisan::call("pmvariation:getdata");
            Artisan::call("pmvariation:updatestock");
            Artisan::call("pmvariation:updateprice");
        })->everyTwoHours();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
