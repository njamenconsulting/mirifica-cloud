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
        Schema::create('product_not_offereds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('productId')->unique() ;
            $table->float('price', 8, 2);
            $table->bigInteger('stock');
            $table->String('name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_not_offereds');
    }
};
