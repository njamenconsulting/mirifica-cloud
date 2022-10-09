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
        Schema::create('pm_variations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('itemId');
            $table->bigInteger('variationId')->unique();
            $table->bigInteger('externalId');
            $table->bigInteger('salesPriceId');
            $table->float('price');
            $table->bigInteger('stock');
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
        Schema::dropIfExists('pm_variations');
    }
};
