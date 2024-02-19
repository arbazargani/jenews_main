<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->longText('meta_description');
            $table->longText('meta_robots');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->integer('category_id')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('hidden')->default(0);
            $table->integer('views')->default(0);
            $table->integer('comments')->default(0);
            $table->integer('likes')->default(0);
            $table->text('cover')->nullable();
            $table->integer('previous_state')->nullable();
            $table->integer('state');
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
        Schema::dropIfExists('articles');
    }
}
