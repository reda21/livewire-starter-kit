<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profiles_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->string('path');
            $table->enum('type', ['avatar', 'cover']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiles_media');
    }
};
