<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('igbd_id')->nullable()->unique();
            $table->string('name');
            $table->string('slug');
            $table->text('summary')->nullable();
            $table->string('cover_img')->nullable();
            $table->json('screenshots')->nullable();
            $table->dateTimeTz('first_released_at')->nullable()->default(now());
            $table->softDeletes();
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
        Schema::dropIfExists('games');
    }
}
