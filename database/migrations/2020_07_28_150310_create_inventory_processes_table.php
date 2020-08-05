<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_processes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('foldername')->nullable();
            $table->string('dropshipper')->nullable();
            $table->string('processid')->nullable();
            $table->string('loopcount')->nullable(); 
            $table->timestamp('started_at')->nullable();
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
        Schema::dropIfExists('inventory_processes');
    }
}
