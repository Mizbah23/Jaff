<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigns', function (Blueprint $table)
        {
            $table->Increments('id');
            
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')
                  ->on('users');
            
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')
                  ->on('courses');
            
            $table->Integer('price');
            $table->Integer('discount');
            $table->text('details');
            
            $table->tinyInteger('status')->default(1);
            $table->Integer('created_by');
            $table->Integer('updated_by')->nullable();
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
        Schema::dropIfExists('assigns');
    }
}
