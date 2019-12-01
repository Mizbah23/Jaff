<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table)
        {
            $table->Increments('slot_id');
            
            $table->unsignedInteger('day_id');
            $table->foreign('day_id')->references('id')
                  ->on('weekdays')->onDelete('cascade');
            
            $table->time('start');
            $table->time('end');
            
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')
                  ->on('types')->nullable();
            
            $table->Integer('price')->nullable();
            
            $table->unsignedInteger('ground_id');
            $table->foreign('ground_id')->references('id')
                  ->on('types')->onDelete('cascade');
            
            $table->tinyInteger('status')->default(1)->nullable();
            
            $table->softDeletes();
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
        Schema::dropIfExists('slots');
    }
}
