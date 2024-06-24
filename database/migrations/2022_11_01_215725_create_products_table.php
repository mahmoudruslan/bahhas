<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('first_appearing')->nullable();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->string('details_ar');
            $table->string('details_en')->nullable();
            $table->string('quantity')->default(1);
            $table->string('image');
            $table->string('price');
            $table->string('book')->nullable();
            $table->string('type')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories');
            $table->foreignId('category_id')->constrained('categories');
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
        Schema::dropIfExists('products');
    }
}
