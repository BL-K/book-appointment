<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital', function (Blueprint $table) {
            $table->increments('hospital_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('hospital_name', 255);
            $table->string('hospital_image', 100);
            $table->string('hospital_contact', 100);
            $table->string('hospital_email', 100);
            $table->string('hospital_url', 100);
            $table->text('hospital_desc');
            $table->string('hospital_address', 255);
            $table->string('hospital_city', 100);
            $table->time('open_week');
            $table->time('close_week');
            $table->time('open_sat');
            $table->time('close_sat');
            $table->time('open_sun');
            $table->time('close_sun');
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
        Schema::dropIfExists('hospital');
    }
}
