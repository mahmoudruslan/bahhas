<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('description_ar');
            $table->string('description_en');
            $table->string('code')->unique();
            $table->string('value');
            $table->tinyInteger('status');
            $table->date('start_date');
            $table->date('expire_date');
            $table->integer('use_times');
            $table->integer('used_times')->default(0);
            $table->integer('greater_than');
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
        Schema::dropIfExists('coupons');
    }
};
