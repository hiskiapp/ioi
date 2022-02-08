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
            $table->string('images')->nullable();
            $table->string('name');
            $table->string('location');
            $table->string('size');
            $table->text('description')->nullable();
            $table->integer('stock');
            $table->integer('price');
            $table->integer('seen_total')->default(0);
            $table->foreignId('categories_id');
            $table->foreignId('sub_categories_id')->nullable();
            $table->string('permalink');
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
