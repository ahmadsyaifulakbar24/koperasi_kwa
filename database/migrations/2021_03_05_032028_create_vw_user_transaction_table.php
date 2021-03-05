<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVwUserTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS vw_user_transaction");
        DB::statement("
        CREATE VIEW vw_user_transaction as 
        select 
            a.id AS user_id, 
            a.code AS code, 
            b.id AS transactions_id, 
            b.pinjaman_id AS pinjaman_id, 
            b.type AS type_transaction, 
            b.approved_date AS transaction_approved_date, 
            b.created_at AS transaction_created_at, 
            c.id AS sub_transactions_id, 
            c.type AS type_sub_transaction, 
            c.besaran AS besaran 
            from 
            (sub_transactions c 
            left join (transactions b 
            left join users a on((a.id = b.user_id))) on((b.id = c.transaction_id)))
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vw_user_transaction');
    }
}
