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
        $table->string('name');
        $table->text('description')->nullable();
        $table->foreignId('client_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['planning', 'development', 'revision', 'done', 'cancelled'])->default('planning');
        $table->integer('progress')->default(0); // 0-100
        $table->date('start_date')->nullable();
        $table->date('deadline')->nullable();
        $table->decimal('budget', 15, 2)->default(0);
        $table->json('files')->nullable();
        $table->text('internal_notes')->nullable();
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
