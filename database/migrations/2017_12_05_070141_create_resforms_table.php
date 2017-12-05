<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resforms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resolution_no')->nullable();
            $table->text('title')->nullable();
            $table->string('sponsors')->nullable();
            $table->date('approved_date')->nullable();
            $table->text('sp_approval')->nullable();
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
        Schema::dropIfExists('resforms');
    }
}
