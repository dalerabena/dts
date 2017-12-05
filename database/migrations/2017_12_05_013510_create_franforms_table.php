<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franforms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ordinance_no')->nullable();
            $table->string('name')->nullable();
            $table->integer('barangay')->nullable();
            $table->enum('status', ['New', 'Renewal', 'Ammendment'])->nullable();
            $table->integer('units')->nullable();
            $table->enum('motor_type', ['Honda', 'Yamaha', 'Kymco', 'Suzuki', 'PMR', 'Motoposh', 'Kawasaki'])->nullable();
            $table->string('motor_no')->nullable();
            $table->string('chassis_no')->nullable();
            $table->string('sidecar_no')->nullable();
            $table->date('approved_date')->nullable();
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
        Schema::dropIfExists('franforms');
    }
}
