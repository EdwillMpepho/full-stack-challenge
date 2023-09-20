<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('reference_no');
            $table->longText('organisation')->nullable();
            $table->longText('province')->nullable();
            $table->longText('district')->nullable();
            $table->longText('city')->nullable();
            $table->longText('street_address')->nullable();
            $table->longText('zipcode')->nullable();
            $table->longText('country');
            $table->longText('gps_location')->nullable();
            $table->longText('facility_name')->nullable();
            $table->longText('facility_type')->nullable();
            $table->longText('provider_name')->nullable();
            $table->longText('position')->nullable();
            $table->longText('phone')->nullable();
            $table->longText('email')->nullable();
            $table->longText('website')->nullable();
            $table->longText('pills_available')->nullable();
            $table->longText('code_to_use')->nullable();
            $table->longText('type_of_service')->nullable();
            $table->longText('note')->nullable();
            $table->longText('womens_evaluation')->nullable();
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
        Schema::dropIfExists('referrals');
    }
}
