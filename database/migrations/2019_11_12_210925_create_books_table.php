<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('category_id');
            $table->bigInteger('writer_id')->nullable();
            $table->bigInteger('translator_id')->nullable();
            $table->bigInteger('nasher_id')->nullable();
            $table->integer('year')->nullable();
            $table->integer('page')->nullable();
            $table->string('booklink')->nullable();
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
        Schema::dropIfExists('books');
    }
}
