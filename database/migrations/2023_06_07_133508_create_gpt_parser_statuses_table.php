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
        Schema::create('gpt_parser_statuses', function (Blueprint $table) {
            $table->id();
            $table->text('request');
            $table->string('status');
            $table->text('message')->nullable();
            $table->unsignedBigInteger('import_id');
            $table->foreign('import_id')->references('id')->on('imports')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gpt_parser_status_by_users');
    }
};
