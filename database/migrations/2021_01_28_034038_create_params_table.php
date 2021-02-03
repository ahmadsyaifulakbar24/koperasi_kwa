<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('params', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('param_id')->unsigned()->nullable();
            $table->string('category_param');
            $table->string('param');
            $table->integer('order');
            $table->boolean('active');
        });

        Schema::table('users', function (Blueprint $table) {
           $table->foreign('pendidikan_id')->references('id')->on('params')->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('jabatan_id')->references('id')->on('params')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('params');
    }
}
