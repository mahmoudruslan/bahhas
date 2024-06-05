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
        Schema::create('bhhaths', function (Blueprint $table) {
            $table->id();
            $table->text('brief_ar');
            $table->text('brief_en');
            $table->string('facebook_link');
            $table->string('youtube_link');
            $table->string('X_link');
            $table->string('instagram_link');
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
        Schema::dropIfExists('bhhaths');
    }
};
