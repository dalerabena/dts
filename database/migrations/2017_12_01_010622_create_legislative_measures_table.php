<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegislativeMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legislative_measures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ord_res_no');
            $table->integer('law_type');
            $table->string('title_subject');
            $table->integer('author');
            $table->integer('co_author');
            $table->integer('proponent');
            $table->integer('co_sponsor');
            $table->integer('referred_to');
            $table->date('referred_when');
            $table->smallInteger('committee_action');
            $table->date('date');
            $table->string('remarks');
            $table->smallInteger('reported')->comment('0 = no; 1 = yes;')->default(0);
            $table->date('reported_when');
            $table->integer('sb_action');
            $table->date('date_enacted_approved');
            $table->date('date_transmitted_to_mayor');
            $table->date('date_approved_by_mayor');
            $table->date('date_transmitted_to_sp');
            $table->string('sp_action');
            $table->string('sp_res_copy');
            $table->smallInteger('implemented')->comment('0 = no; 1 = yes;')->default(0);
            $table->string('print_copy');
            $table->smallInteger('vetoed')->comment('0 = no; 1 = yes; 2 = returned;')->default(0);
            $table->string('vetoad_reason');
            $table->string('note');
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
        Schema::dropIfExists('legislative_measures');
    }
}
