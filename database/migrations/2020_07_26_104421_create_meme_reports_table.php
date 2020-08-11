<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemeReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meme_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('reason', array('Violations of privacy', 'Spam', 'Personal disputes', 'Discrimination'));
            $table->string('explanation');
            $table->unsignedInteger('meme_id');
            $table->foreign('meme_id')->references('id')->on('memes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('meme_reports');
    }
}
