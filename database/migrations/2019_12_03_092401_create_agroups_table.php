<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agroups', function (Blueprint $table) 
        {
            $table->Increments('grpid');
            $table->unsignedInteger('secid');
            $table->foreign('secid')->references('secid')
                  ->on('asections')->onDelete('cascade');
            $table->string('grp_name')->nullable();
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
        Schema::dropIfExists('agroups');
    }
}
