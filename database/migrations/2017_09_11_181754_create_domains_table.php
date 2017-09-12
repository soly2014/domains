<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {

            $table->increments('id');
            $table->string('actiontypedesc');
            $table->string('unutilisedsellingamount');
            $table->string('sellingamount');
            $table->string('entityid');
            $table->string('actionstatus');
            $table->string('status');
            $table->string('eaqid');
            $table->string('customerid');
            $table->string('description');
            $table->string('actiontype');
            $table->string('invoiceid');
            $table->string('sellingcurrencysymbol');
            $table->integer('customer_id')->unsigned();//17602107',
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')
                                                           ->onDelete('cascade')
                                                           ->onUpdate('cascade'); 


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domains');
    }
}
