<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegislativeMeasureCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legislative_measure_copies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('legislative_measure_id');
            $table->string('filename');
            $table->string('path');
            $table->smallInteger('type')->comment('1 = sp res copy; 2 = print copy;');
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
        Schema::dropIfExists('legislative_measure_copies');
    }
}
