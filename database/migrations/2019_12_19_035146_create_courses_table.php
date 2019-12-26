<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table)
        {
            $table->Increments('id');
            $table->unsignedInteger('coach_id')->nullable();
            $table->foreign('coach_id')->references('id')
                  ->on('coaches');
            $table->string('title');
            $table->Integer('price');
            $table->string('batch');
            $table->text('details')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
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
        Schema::dropIfExists('courses');
    }
}
