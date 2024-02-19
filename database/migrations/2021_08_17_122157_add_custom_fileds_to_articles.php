<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomFiledsToArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->longText('lead')->nullable();
            $table->string('rootitr')->nullable();
            $table->string('writer')->nullable();
            $table->string('type')->default('text');
            $table->string('video_url')->nullable();
            $table->string('attachment_url')->nullable();
            $table->string('gallery_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            //
        });
    }
}
