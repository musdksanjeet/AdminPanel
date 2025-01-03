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
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->string('product_name');
            $table->string('product_url');
            $table->integer('quantity');
            $table->string('product_code');
            $table->string('product_color');
            $table->string('family_colors');
            $table->string('group_code');
            $table->float('product_price');
            $table->float('product_discount');
            $table->string('discount_type');
            $table->float('final_price');
            $table->string('product_weight');
            $table->string('product_video');
            $table->text('description');
            $table->text('wash_care');
            $table->string('keywords');
            $table->string('pattern');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->enum('is_featured',['No','Yes']);
            $table->tinyinteger('status');
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
