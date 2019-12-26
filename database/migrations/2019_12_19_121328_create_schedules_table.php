<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table)
        {
            $table->Increments('id');
            
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')
                  ->on('courses');
            
            $table->unsignedInteger('slot_id');
            $table->foreign('slot_id')->references('slot_id')
                  ->on('slots');
            
            $table->date('date');
            $table->tinyInteger('status')->default(1)->nullable();
            $table->Integer('created_by')->nullable();
            
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
        Schema::dropIfExists('schedules');
    }
}
