<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_record', function (Blueprint $table) {
            $table->increments('medical_record_id');
            $table->integer('appointment_id')->unsigned();
            $table->foreign('appointment_id')
                ->references('appointment_id')->on('appointment')
                ->onDelete('cascade');
            $table->string('medical_record');
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
        Schema::dropIfExists('medical_record');
    }
}
