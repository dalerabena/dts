<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_id');
            $table->integer('assigned_to');
            $table->string('forwarded_to');
            $table->mediumText('comment');
            $table->smallInteger('status')->comment('0 = open; 1 = closed;')->default(0);
            $table->integer('opened_by')->nullable();
            $table->integer('closed_by')->nullable();
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
        Schema::dropIfExists('tracks');
    }
}
