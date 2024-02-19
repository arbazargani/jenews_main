<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->string('link')->nullable();
            $table->string('author')->nullable();
            $table->longText('content')->nullable();
            $table->string('socket');
            $table->string('type');
            $table->integer('views')->default(0);
            $table->integer('state')->default(1);
            $table->integer('mobile_only')->default(0);
            $table->integer('just_admin')->default(0);
            $table->timestamp('expires_at');
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
        Schema::dropIfExists('advertises');
    }
}
