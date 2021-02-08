<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // insert tagihan simpanan wajib setiap bulan
        // $schedule->command('insert:tagihanSimpananWajib')->monthlyOn(3, '08:00');
        // $schedule->command('insert:tagihanPinjaman')->monthlyOn(3, '08:00');
        $schedule->call(function () {
            DB::table('params')->insert([
                'param_id' => null,
                'category_param' => 'jabatan',
                'param' => 'Sales / Marketing',
                'order' => 4,
                'active' => 1,
            ]);
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
