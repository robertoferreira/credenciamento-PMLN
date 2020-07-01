<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->string('title');
            $table->string('number');
            $table->string('published');
            $table->string('open');
            $table->text('object');
            $table->string('docs');
            $table->string('status');
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
        Schema::dropIfExists('outlet_prices');
    }
}
