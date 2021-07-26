<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('c_id');
            $table->date('o_orderdate');
            $table->date('o_shipdate');
            $table->enum('o_paymentstatus', ['paid', 'not_paid'])->default('not_paid')->nullable();
            $table->enum('o_orderstatus', ['pending', 'packed', 'shipped', 'delivered'])->default('pending')->nullable();
            $table->text('o_transactionid')->nullable();
            $table->string('o_name','50')->nullable();
            $table->string('o_company','100')->nullable();
            $table->text('o_address1')->nullable();
            $table->text('o_address2')->nullable();
            $table->string('o_city','50')->nullable();
            $table->string('o_country','50')->nullable();
            $table->string('o_state','50')->nullable();
            $table->string('o_postalcode','50')->nullable();
            $table->string('o_phone','50')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
