<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content');
            $table->unsignedBigInteger('article_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->string('family')->nullable();
            $table->text('email');
            $table->string('website')->nullable();
            $table->boolean('approved')->default(0);

            $table->timestamps();
        });
        Schema::create('article_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('article_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->integer('comment_id')->unsigned();
            $table->primary(['article_id', 'comment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('article_comments');
    }
}
