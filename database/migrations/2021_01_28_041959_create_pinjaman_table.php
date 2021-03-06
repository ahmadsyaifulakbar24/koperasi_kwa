<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('angsuran')->nullable();
            $table->bigInteger('besar_pinjaman');
            $table->integer('tenor')->nullable();
            $table->bigInteger('total_bayar')->nullable();
            $table->bigInteger('sisa_bayar')->nullable();
            $table->enum('status', ['approved', 'rejected', 'pending', 'paid_off']);
            $table->timestamp('approved_date')->nullable();
            $table->string('transaction_type');
            $table->string('description')->nullable();
            $table->timestamp('paid_off_date')->nullable();
            $table->string('contract')->nullable();
            $table->timestamps();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('pinjaman_id')->references('id')->on('pinjaman')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjaman');
    }
}
