<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('barcode')->nullable();
            $table->integer('category_id');
            $table->string('title')->nullable();
            $table->text('overview')->nullable();
            $table->string('isbn_no')->nullable();
            $table->string('publisher')->nullable();
            $table->string('author')->nullable();
            $table->string('image')->nullable()->comment('books cover image');
            $table->string('pdf_file')->nullable()->comment('ebook to upload pdf file if available');
            $table->boolean('is_available');
            $table->dateTime('published_date')->nullable();
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
