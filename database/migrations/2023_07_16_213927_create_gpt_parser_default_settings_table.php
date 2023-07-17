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
        Schema::create('gpt_parser_default_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('default');
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('values')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gpt_parser_default_settings');
    }
};
