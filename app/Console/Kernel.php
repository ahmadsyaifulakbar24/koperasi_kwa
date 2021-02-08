<?php

namespace App\Console;

use App\Models\Transaction;
use App\Models\User;
use App\Models\UserKoperasiDetail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
            $users =  User::where([['user_level_id', 101], ['active', 1]])->get();
            foreach ($users as $user) {
                $user_koperasi_detail = UserKoperasiDetail::where('user_id', $user->id)->first();
                $transaction_data = [
                    'user_id' => $user->id,
                    'title' => 'Tagihan bulanan',
                    'message' => 'ini notifikasi tagihan bulanan',
                    'type' => 'simpanan',
                ];
                $sub_transaction_data = [
                    'type' => 'simpanan_wajib',
                    'besaran' => $user_koperasi_detail['besar_simpanan_wajib'],
                ];
                $transaction = Transaction::create($transaction_data);
                $transaction->sub_transaction()->create($sub_transaction_data);
            }
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
