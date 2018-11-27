<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rarities', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('name', ['Common', 'Uncommon', 'Rare', 'Epic', 'Legendary'])->default('Common')->unique();
            $table->smallInteger('level');
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
        Schema::dropIfExists('rarities');
    }
}
