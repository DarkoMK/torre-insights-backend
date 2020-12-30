<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_log', function (Blueprint $table) {
            $table->id();
            $table->string('org')->nullable()->default(null);
            $table->json('remoter')->nullable()->default(null);
            $table->json('skill')->nullable()->default(null);
            $table->json('compensationrange')->nullable()->default(null);
            $table->json('map')->nullable()->default(null);
            $table->integer('total')->nullable()->default(null);
            $table->boolean('success')->nullable()->default(null);
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
        Schema::dropIfExists('history_log');
    }
}
