<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table)
        {
            $table->Increments('book_id');
            $table->text('notes');
            $table->Integer('booked_for');
            $table->Integer('less')->comment('less paid amount')->default(0);
            $table->tinyInteger('status')->comment('0=due|1=paid|2=partial'); 
            $table->tinyInteger('user_type')->comment('1=admin|2=user');
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
        Schema::dropIfExists('bookings');
    }
}
