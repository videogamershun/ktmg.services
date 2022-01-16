<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NoticeBoard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_board', function (Blueprint $table) {
           $table->integer('board_int');
            $table->string('name');
            $table->string('text');
            $table->timestamp('created_at')->nullable();
            $table->string('created_by');
            $table->string('board_for');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_board');
    }
}
