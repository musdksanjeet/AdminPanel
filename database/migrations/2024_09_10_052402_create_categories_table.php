<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('category_name')->nullable();
            $table->string('category_image')->nullable();
            $table->string('category_discount')->nullable();
            $table->string('category_description')->nullable();
            $table->string('category_url')->nullable();
            $table->string('category_meta_title')->nullable();
            $table->string('category_meta_description')->nullable();
            $table->string('category_meta_keyword')->nullable();
            $table->tinyinteger('category_status');
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
        Schema::dropIfExists('categories');
    }
}
