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
            $table->increments('id');
            $table->string('title', 1024)->nullable();
            $table->string('published_scope', 255)->nullable();
            $table->string('vendor', 255)->nullable();
            $table->string('handle', 255)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('template_suffix', 255)->nullable();
            $table->text('body_html')->nullable();
            $table->text('tags')->nullable();
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->unsignedBigInteger('option_id')->nullable();
            $table->unsignedBigInteger('image_id')->nullable();
            $table->unsignedBigInteger('shopify_id');
            $table->unsignedBigInteger('admin_graphql_api_id')->nullable();
            //$table->unsignedBigInteger('product_type_id')->index();
            //$table->foreign('product_type_id')->references('id')->on('categories');
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
