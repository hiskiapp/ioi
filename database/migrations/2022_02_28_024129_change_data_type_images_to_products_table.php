<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeImagesToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voidw
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->json('images')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('images')->nullable()->change();
        });
    }
}
