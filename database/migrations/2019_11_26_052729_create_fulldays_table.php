<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFulldaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fulldays', function (Blueprint $table)
        {
            $table->Increments('id');
            $table->date('date');
            $table->string('details');
            $table->Integer('price');
            $table->unsignedInteger('ground_id');
            $table->foreign('ground_id')->references('id')
                  ->on('grounds')->onDelete('cascade');
            $table->tinyinteger('status')->nullable()
                  ->default(0)->comment('0=inactive|1=active');
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
        Schema::dropIfExists('fulldays');
    }
}
