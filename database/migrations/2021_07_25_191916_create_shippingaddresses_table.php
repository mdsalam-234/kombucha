<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingaddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippingaddresses', function (Blueprint $table) {
            $table->id();
            $table->integer('o_id');
            $table->string('sh_fname','50')->nullable();
            $table->string('sh_lname','50')->nullable();
            $table->string('sh_company','100')->nullable();
            $table->text('sh_address1')->nullable();
            $table->text('sh_address2')->nullable();
            $table->string('sh_city','100')->nullable();
            $table->string('sh_country','100')->nullable();
            $table->string('sh_state','100')->nullable();
            $table->string('sh_postalcode','100')->nullable();
            $table->string('sh_phone','100')->nullable();
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
        Schema::dropIfExists('shippingaddresses');
    }
}
