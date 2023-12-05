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
        Schema::create('texts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->string('language');
            $table->timestamps();
        });

        Schema::create('sentences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('text_id')->constrained()->cascadeOnDelete();
            $table->float('start_at');
            $table->float('end_at');
            $table->text('content');
            $table->boolean('new_paragraph')->default(false);
            $table->timestamps();
        });

        Schema::create('translated_sentences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sentence_id')->constrained()->cascadeOnDelete();
            $table->string('language');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('texts');
        Schema::dropIfExists('sentences');
        Schema::dropIfExists('translated_sentences');
    }
};
