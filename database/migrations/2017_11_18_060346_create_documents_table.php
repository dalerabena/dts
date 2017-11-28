<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('reference_number');
            $table->string('subject');
            $table->mediumText('detail');
            $table->smallInteger('priority')->comment('0 = normal; 1 = urgent; 2 = high;')->default(0);
            $table->integer('department');
            $table->mediumText('initial_comment');
            $table->smallInteger('status')->comment('0 = open; 1 = closed;')->default(0);
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
        Schema::dropIfExists('documents');
    }
}
