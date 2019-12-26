<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->Increments('id');
            
            $table->string('code')->nullable();
            
            $table->unsignedInteger('userid');
            $table->foreign('userid')->references('id')
                  ->on('users')->onDelete('cascade');
            
            $table->unsignedInteger('mid');
            $table->foreign('mid')->references('id')
                  ->on('memberships')->onDelete('cascade');
            
            $table->date('start_date');
            $table->date('end_date');

            $table->tinyInteger('ispaid')->default(0)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            
            $table->tinyInteger('status')
                  ->default(0)->nullable()
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
        Schema::dropIfExists('members');
    }
}
