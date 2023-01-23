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
            $table->bigIncrements('id');
            
            $table->string('language_abbr', 2)->nullable();
            $table->integer('category_id')->default('0');
            $table->integer('brand_id')->default('0');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('image', 255)->nullable();
            $table->longtext('description')->nullable();
            $table->text('short_description', 500)->nullable();
            $table->float('rating')->nullable();
            $table->json('extras')->nullable();
            $table->boolean('is_hit')->default('0');
            $table->boolean('is_active')->default('1');
            
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
