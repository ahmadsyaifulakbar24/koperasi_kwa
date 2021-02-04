<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserKoperasiDetail;

class InsertTagihanSimpananWajib extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:tagihanSimpananWajib';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'untuk insert data transaction tagihan simpanan wajib setiap bulan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
    }
}
