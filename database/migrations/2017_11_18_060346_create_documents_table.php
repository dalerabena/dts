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
            $table->string('reference_number');
            $table->string('subject');
            $table->mediumText('detail');
            $table->smallInteger('priority')->comment('0 = normal; 1 = urgent; 2 = high;')->default(0);
            $table->integer('department');
            $table->integer('initiator');
            $table->mediumText('attachment')->nullable();
            $table->mediumText('comment');
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
