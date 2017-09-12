<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('customer_id')->default(0);
            $table->bigInteger('contact_id')->default(0);
            $table->string('username');
            $table->string('passwd');
            $table->string('name');
            $table->string('company');
            $table->string('address_line_1');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zipcode');
            $table->string('phone_cc');
            $table->string('phone');
            $table->string('email');
            $table->string('lang_pref');           
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
        Schema::dropIfExists('customers');
    }
}
