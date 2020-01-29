<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('league');
            $table->string('home');
            $table->string('away');
            $table->string('slug')->nullable();
            $table->string('tip');
            $table->string('outcome')->nullable();
            $table->string('odd')->nullable();
            $table->dateTime('time');
            $table->boolean('pro')->default(false);
            $table->boolean('won')->nullable();

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
        Schema::dropIfExists('matches');
    }
}
