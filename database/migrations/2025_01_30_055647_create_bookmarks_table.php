<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('recipe_id')->constrained('reseps')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['user_id', 'recipe_id']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
};