<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->integer('duration');
            $table->integer('fee')->default(0)->nullable();
            $table->boolean('discount')->default(0)->nullable();
            $table->tinyInteger('status')->default(0)->nullable()
                    ->comment('0=inactive|1=active');
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
        Schema::dropIfExists('memberships');
    }
}
