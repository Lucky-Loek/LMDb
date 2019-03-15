<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScreeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screenings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('screenings')->onDelete('cascade');

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');

            $table->string('title');
            $table->string('year');
            $table->string('runtime');
            $table->string('poster_file_path');
            $table->string('imdb_rating');
            $table->string('imdb_id');
            $table->integer('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('screenings');
    }
}