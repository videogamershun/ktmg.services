<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventJoined extends Migration
{
    public function up()
    {
        Schema::create('event_joined', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('event_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_joined');
    }
}
