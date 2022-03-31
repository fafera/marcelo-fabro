<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongSongbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_songbook', function (Blueprint $table) {
            $table->id();
            $table->foreignId('song_id')->constrained('songs')->onDelete('CASCADE');
            $table->foreignId('songbook_id')->constrained('songbooks')->onDelete('CASCADE');
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
        Schema::dropIfExists('song_songbook');
    }
}
