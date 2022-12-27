<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCooperationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperation', function (Blueprint $table) {
            $table->increments('cooperation_id');
            $table->string('person_name', 255);
            $table->string('person_contact', 100);
            $table->string('person_email', 255);
            $table->string('hospital_name', 255);
            $table->string('hospital_address', 255);
            $table->text('cooperation_content');
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
        Schema::dropIfExists('cooperation');
    }
}
