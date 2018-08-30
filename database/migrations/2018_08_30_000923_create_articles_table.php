<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('article_id');
            $table->timestamps();
            $table->string('name',100);
            $table->text('description');
            $table->unsignedInteger('amount');
            $table->unsignedDecimal('price', 8,2);
            $table->string('image',250)->default('https://broxtechnology.com/images/iconos/boxs.png');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
