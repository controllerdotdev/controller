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
        Schema::create('issue_events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('issue_id')->constrained()->onDelete('cascade');
            $table->string('environment');
            $table->string('release')->nullable();
            $table->json('user_data')->nullable();
            $table->json('request_data');
            $table->json('context')->nullable();
            $table->json('tags')->nullable();
            $table->timestamps();

            $table->index(['issue_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_events');
    }
};
