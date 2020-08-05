<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDropshipperInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dropshipper_inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fetcher')->nullable();
            $table->string('location_name')->nullable();
            $table->string('dropshipper_id')->nullable();
            $table->string('partno')->nullable();
            $table->string('vendor_partno')->nullable();
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->string('fetch_date')->nullable();
            $table->string('zip')->nullable(); 
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
        Schema::dropIfExists('dropshipper_inventories');
    }
}
