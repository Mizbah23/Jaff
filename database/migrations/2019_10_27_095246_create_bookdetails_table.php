<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookdetails', function (Blueprint $table)
        {
            $table->Increments('id');
            
            $table->unsignedInteger('book_id');
            $table->foreign('book_id')->references('book_id')
                  ->on('bookings')->onDelete('cascade');
            
            $table->integer('slot_id');
            $table->date('slot_date');
            $table->integer('price');
            $table->integer('discount')->default(0)->nullable();
            $table->integer('book_price');
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
        Schema::dropIfExists('bookdetails');
    }
}
