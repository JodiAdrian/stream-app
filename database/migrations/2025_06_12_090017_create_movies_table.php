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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('trailer');
            $table->string('movie'); // URL dari film tersebut
            $table->string('cast');
            $table->string('categories');
            $table->string('small_thumbnail');
            $table->string('large_thumbnail');
            $table->date('release_date');
            $table->text('about'); //deskripsi film
            $table->string('short_about'); //deskripsi lebih panjang
            $table->string('duration'); //deskripsi lama film
            $table->boolean('featured'); //apakah sedang trending, jika ya akan diurutan atas
            $table->softDeletes();//fitur laravel agar tidak langsung terhapus di db
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
        Schema::dropIfExists('movies');
    }
};
