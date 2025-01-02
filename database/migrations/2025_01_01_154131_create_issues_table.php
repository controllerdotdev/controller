<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('workspace_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('project_id')->constrained()->onDelete('cascade');
            $table->string('fingerprint')->index();
            $table->string('title');
            $table->text('message')->nullable();
            $table->string('status')->default('open');
            $table->string('priority')->default('medium');
            $table->string('platform');
            $table->string('environment');
            $table->string('release')->nullable();
            $table->string('transaction')->nullable();
            $table->string('exception_class');
            $table->string('exception_file');
            $table->integer('exception_line');
            $table->json('stack_trace');
            $table->json('context')->nullable();
            $table->json('request_data')->nullable();
            $table->json('tags')->nullable();
            $table->integer('events_count')->default(1);
            $table->boolean('has_seen')->default(false);
            $table->timestamp('first_seen_at');
            $table->timestamp('last_seen_at');
            $table->timestamps();
            $table->softDeletes();

            // Índices para performance
            $table->index(['workspace_id', 'project_id', 'environment']);
            $table->index('status');
            $table->index('last_seen_at');
        });


    }

    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
