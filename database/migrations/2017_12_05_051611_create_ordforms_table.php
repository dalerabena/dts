<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordforms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ordinance_no')->nullable();
            $table->text('subject_matter')->nullable();
            $table->string('sponsors')->nullable();
            $table->date('approved_date')->nullable();
            $table->text('sp_actions')->nullable();
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
        Schema::dropIfExists('ordforms');
    }
}
