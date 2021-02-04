<?php

namespace App\Console\Commands;

use App\Models\Pinjaman;
use App\Models\Transaction;
use Illuminate\Console\Command;

class InsertTagihanPinjaman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:tagihanPinjaman';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'untuk insert data transaction tagihan pinjaman setiap bulan';

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
        $pinjamans = Pinjaman::whereNull('paid_off_date')->get();
        foreach($pinjamans as $pinjaman) {
            $transaction_data = [
                'user_id' => $pinjaman->user_id,
                'pinjaman_id' => $pinjaman->id,
                'title' => 'Tagihan Peminjaman Bulanan',
                'message' => 'ini notifikasi tagihan peminjaman bulanan',
                'type' => 'pinjaman',
            ];
            $sub_transaction_data = [
                'type' => 'tagihan_pinjaman',
                'besaran' => $pinjaman['angsuran'],
            ];
            $transaction = Transaction::create($transaction_data);
            $transaction->sub_transaction()->create($sub_transaction_data);
        }
    }
}
