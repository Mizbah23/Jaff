<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offerdetails', function (Blueprint $table)
        {
            $table->Increments('id');
            $table->unsignedInteger('offer_id');
            $table->foreign('offer_id')->references('id')
                  ->on('offers')->onDelete('cascade');
            $table->integer('slot_id');
            $table->date('offer_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offerdetails');
    }
}
