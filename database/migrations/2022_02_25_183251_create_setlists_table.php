<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')->constrained('quotes');
            $table->foreignId('song_id')->nullable()->constrained('songs');
            $table->foreignId('moment_id')->nullable()->constrained('moments');
            $table->foreignId('custom_song_id')->nullable()->constrained('custom_songs');
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
        Schema::dropIfExists('setlists');
    }
}
