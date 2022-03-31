<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientEventPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_event_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('client_id')->constrained('clients')->onDelete('CASCADE');
            $table->foreignId('quote_id')->constrained('quotes')->onDelete('CASCADE');
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
        Schema::dropIfExists('client_event_pages');
    }
}
