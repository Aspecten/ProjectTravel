<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id(); // Первичный ключ
            $table->string('title'); // Название тура
            $table->decimal('price', 8, 2); // Цена тура
            $table->text('highlights'); // Основные данные
            $table->text('description'); // Полное описание
            $table->string('country'); // Страна
            $table->string('city'); // Город
            $table->string('hotel_name'); // Название отеля
            $table->string('image_path')->nullable(); // Путь к фото тура
            $table->timestamps(); // Таймстемпы для отслеживания создания и обновления
        });
    }

    public function down()
    {
        Schema::dropIfExists('tours'); // Удаление таблицы
    }
}
