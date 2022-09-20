<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('post_code')->nullable();
            $table->bigInteger('post_id')->nullable();
            $table->bigInteger('comment_id')->nullable();
            $table->datetime('commented_at')->nullable();
            $table->text('comment_text')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('username')->nullable();
            $table->text('profile_picture')->nullable();
            $table->integer('exported')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
    }
}
