<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullcalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fullcalendars', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('fechaStart');
            $table->datetime('fechaEnd')->nullable();
            $table->boolean('allDay')->nullable();
            $table->string('color')->nullable();
            $table->mediumText('title')->nullable;
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
        Schema::dropIfExists('fullcalendars');
    }
}
