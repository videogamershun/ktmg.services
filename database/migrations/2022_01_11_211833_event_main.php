<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventMain extends Migration
{

    public function up()
    {
        Schema::create('event_main', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->string('name');
            $table->string('owner');
            $table->text('description');
            $table->timestamp('event_when')->nullable();
            $table->integer('max_members');
            $table->string('event_for');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_main');
    }
}
