<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor', function (Blueprint $table) {
            $table->increments('doctor_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('doctor_name', 100);
            $table->string('doctor_avatar', 100);
            $table->string('speciality_name', 100);
            $table->string('doctor_experience', 100);
            $table->date('doctor_dob');
            $table->string('doctor_gender', 100);
            $table->string('doctor_contact', 100);
            $table->string('doctor_email', 100);
            $table->text('doctor_desc');
            $table->string('doctor_address', 255);
            $table->string('doctor_city', 100);
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
        Schema::dropIfExists('doctor');
    }
}
