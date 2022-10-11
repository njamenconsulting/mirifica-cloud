<?php

namespace App\Console;

use App\Http\Controllers\Plentymarket\PmShopController;
use App\Http\Controllers\Plentymarket\PmVariationController;
use App\Http\Controllers\Trenz\TrenzProductController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        $schedule->call(function () {
            (new TrenzProductController)->updateOrInsert();
            (new PmVariationController())->update();
            (new PmShopController())->updateSalesPrice();
            (new PmShopController())->updateStock();
        })->everyMinute();

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
