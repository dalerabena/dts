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
            $table->integer('user_id');
            $table->integer('law_type');
            $table->string('ord_res_no');
            $table->string('title_subject');
            $table->string('authors')->nullable();
            $table->string('co_authors')->nullable();
            $table->string('proponents')->nullable();
            $table->string('co_sponsors')->nullable();
            $table->string('referred_to')->nullable();
            $table->string('referred_when')->nullable();
            $table->smallInteger('committee_action')->nullable();
            $table->date('committee_action_date')->nullable();
            $table->string('remarks')->nullable();
            $table->smallInteger('reported')->comment('0 = no; 1 = yes;')->nullable();
            $table->string('reported_when')->nullable();
            $table->integer('sb_action')->nullable();
            $table->date('enacted_approved_date')->nullable();
            $table->date('date_transmitted_to_mayor')->nullable();
            $table->date('date_approved_by_mayor')->nullable();
            $table->date('date_transmitted_to_sp')->nullable();
            $table->string('sp_action')->nullable();
            $table->smallInteger('implemented')->comment('0 = no; 1 = yes;')->nullable();
            $table->smallInteger('vetoed')->comment('0 = no; 1 = yes; 2 = returned;')->nullable();
            $table->string('vetoed_reasons')->nullable();
            $table->string('notes')->nullable();
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
