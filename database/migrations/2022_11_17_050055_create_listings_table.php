<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id('stock_id'); // Primary key
            $table->string('stock_name'); // stock attribute
            $table->string('stock_image')->nullable(); // stock attribute
            $table->string('tags'); // stock attribute
            $table->double('stock_price'); // stock attribute
            $table->integer('stock_quantity'); // stock attribute
            $table->longText('stock_description'); // stock attribute
            $table->timestamps(); // time information
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
};
