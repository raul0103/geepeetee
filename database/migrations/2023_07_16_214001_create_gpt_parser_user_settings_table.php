<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gpt_parser_user_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('default_setting_id');
            $table->foreign('default_setting_id')->references('id')->on('gpt_parser_default_settings')->onDelete('cascade');
            $table->string('value');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gpt_parser_user_settings');
    }
};
