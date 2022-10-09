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
        Schema::create('update_reports', function (Blueprint $table) {
            $table->id();
            $table->enum('fieldname', ['price', 'stock']);
            $table->bigInteger('itemId');
            $table->bigInteger('variationId');
            $table->bigInteger('externalId');
            $table->bigInteger('salesPriceId');
            $table->float('old_value');
            $table->float('new_value');
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
        Schema::dropIfExists('update_reports');
    }
};
