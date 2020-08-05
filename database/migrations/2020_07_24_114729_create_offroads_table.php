<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffroadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offroads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('offroadid')->nullable();
            $table->string('plussizetype')->nullable();
            $table->string('sort')->nullable();
            $table->string('wheeldiameter')->nullable();
            $table->string('wheelwidth')->nullable();
            $table->string('tire1')->nullable();
            $table->string('tire1search')->nullable();
            $table->string('offsetmin')->nullable();
            $table->string('offsetmax')->nullable();
            $table->string('offroadrowid')->nullable();
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
        Schema::dropIfExists('offroads');
    }
}
