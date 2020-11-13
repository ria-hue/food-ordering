<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            //name
            $table->string('first_name');
            $table->string('last_name');
            //address
            $table->string('location'); 
            $table->string('zip_code');
            $table->string('voucher');
            $table->string('vender');
            $table->string('mobile_number');
            //*email
            $table->string('email');
        
            //order
            $table->string('the_special');
            $table->string('product');
            $table->string('total');
           // payment
           $table->string('mobile_money');
           $table->string('cash');
           $table->string('account_tranfer');
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
        Schema::dropIfExists('posts');
    }
}
