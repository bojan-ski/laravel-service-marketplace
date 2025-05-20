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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->enum('budget_type', ['fixed', 'hourly']);
            $table->decimal('budget_amount', 10, 2)->nullable();
            $table->decimal('hour_price', 3, 2)->nullable();
            $table->date('deadline');
            $table->string('documents_path')->nullable();
            $table->enum('status', ['open', 'in_progress', 'pending_review', 'completed', 'cancelled'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
