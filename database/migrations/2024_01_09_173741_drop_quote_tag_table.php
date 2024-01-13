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
        Schema::drop('quote_tag');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('quote_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->references('id')->on('tags')->cascadeOnDelete();
            $table->foreignId('quote_id')->references('id')->on('quotes')->cascadeOnDelete();
        });
    }
};
