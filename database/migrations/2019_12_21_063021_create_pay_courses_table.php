<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_courses', function (Blueprint $table)
        {
            $table->Increments('id');
            $table->unsignedInteger('assign_id');
            $table->foreign('assign_id')->references('id')
                  ->on('assigns')->onDelete('cascade');
            $table->date('date');
            $table->Integer('amount');
            $table->text('details')->nullable();
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
        Schema::dropIfExists('pay_courses');
    }
}
