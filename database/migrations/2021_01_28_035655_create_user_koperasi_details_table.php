<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserKoperasiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_koperasi_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('status_keluarga_id')->constrained('params')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_ahliwaris');
            $table->bigInteger('besar_simpanan_wajib');
            $table->string('upload_ktp');
            $table->bigInteger('saldo_simpanan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_koperasi_details');
    }
}
