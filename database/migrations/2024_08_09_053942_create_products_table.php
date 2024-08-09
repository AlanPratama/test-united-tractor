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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("product_category_id")->nullable();
            // $table->foreign("product_category_id")->references("id")->on("category_products");
            $table->foreign("product_category_id")->references("id")->on("category_products")->onDelete('set null'); // <= bakalan null kalau category nya dihapus

            $table->string('name');
            $table->integer('price')->default(0);
            $table->string('image')->nullable();


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
};
