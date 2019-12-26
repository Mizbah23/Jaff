<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table)
        {
            $table->Increments('id');
            
            $table->unsignedInteger('accid');
            $table->foreign('accid')->references('accid')
                  ->on('accounts')->onDelete('cascade');
            
            $table->date('date');
            $table->float('amount')->default(0.0);
            $table->text('details')->nullable();
            
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
        Schema::dropIfExists('balances');
    }
}
