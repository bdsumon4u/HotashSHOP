<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('distributors');
        Schema::create('distributors', function (Blueprint $table) {
            $table->id();
            $table->string('photo');
            $table->string('type')->default('Distributor');
            $table->string('full_name');
            $table->string('shop_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('address');
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
        Schema::dropIfExists('distributors');
    }
}
