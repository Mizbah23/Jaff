<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDropinsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('dropins', function (Blueprint $table)
        {
            $table->Increments('id');
            $table->date('date');
            $table->unsignedInteger('ground_id');
            $table->foreign('ground_id')->references('id')
                  ->on('grounds')->onDelete('cascade');
            $table->unsignedInteger('slot_id');
            $table->foreign('slot_id')->references('slot_id')
                  ->on('slots')->onDelete('cascade');
            $table->Integer('seat');
            $table->Integer('taken')->default(0)->nullable();
            $table->Integer('price');
            $table->tinyinteger('status')->nullable()
                    ->default(0)->comment('0=inactive|1=active');
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
        Schema::dropIfExists('dropins');
    }
}
