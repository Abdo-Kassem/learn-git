<?php

namespace App\Console;

use App\Jobs\NotifyAfterDeleteProduct;
use App\Jobs\NotifyBeforDeleteProduct;
use App\Models\Subscription;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        
        $schedule->call(function() {
            Subscription::whereDate('end_at', '<', now())
                ->update(['is_expired' => true]);
        })->twiceDaily(1,13);

        $schedule->job(new NotifyBeforDeleteProduct())->dailyAt('15.00');
        $schedule->job(new NotifyAfterDeleteProduct())->dailyAt('15.00');
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
