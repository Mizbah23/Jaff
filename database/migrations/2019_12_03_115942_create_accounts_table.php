<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->Increments('accid');
            
            $table->unsignedInteger('secid');
            $table->foreign('secid')->references('secid')
                  ->on('asections')->onDelete('cascade');
            
            $table->unsignedInteger('grpid')->nullable();
            $table->foreign('grpid')->references('grpid')
                  ->on('agroups')->onDelete('cascade');
            
            $table->string('acc_name')->nullable();
            $table->string('details')->nullable();
            $table->tinyInteger('type')->comment('1=income|2=expense');
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
        Schema::dropIfExists('accounts');
    }
}
