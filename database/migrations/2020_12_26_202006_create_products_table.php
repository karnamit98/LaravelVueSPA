<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('products', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id');
        //     $table->string('type');
        //     $table->string('title');
        //     $table->string('firstname');
        //     $table->string('mainname');
        //     $table->double('price');
        //     $table->integer('pageslength');
        //     $table->timestamps();
        // });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('type');
            $table->string('title');
            $table->string('firstname');
            $table->string('mainname');
            $table->double('price');
            $table->integer('pageslength');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
