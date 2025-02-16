<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('quote'); // Текст цитаты
            $table->string('author')->nullable(); // Автор цитаты (может быть пустым)
            $table->integer('year')->nullable(); // Год (может быть пустым)
            $table->string('source')->nullable(); // Источник цитаты
            $table->string('category')->nullable(); // Категория цитаты
            $table->integer('likes')->default(0); // Лайки, по умолчанию 0
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
        Schema::dropIfExists('quotes');
    }
}
