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
        Schema::create('history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_id');
            $table->string('forwarded_to')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('subject')->nullable();
            $table->mediumText('detail')->nullable();
            $table->mediumText('comment')->nullable();
            $table->smallInteger('action')->comment('0 = created; 1 = updated; 2 = forwarded; 3 = closed;');
            $table->integer('action_by')->nullable();
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
