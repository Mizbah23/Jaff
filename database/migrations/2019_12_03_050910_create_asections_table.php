<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asections', function (Blueprint $table)
        {
            $table->Increments('secid');
            $table->string('sec_name');
            $table->string('details')->nullable();
            $table->tinyInteger('status')->deafult(1)->nullable();
            $table->Integer('created_by')->nullable();
            $table->Integer('updated_by')->nullable();
            $table->Integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asections');
    }
}
