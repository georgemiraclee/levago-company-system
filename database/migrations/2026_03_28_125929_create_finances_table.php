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
    Schema::create('finances', function (Blueprint $table) {
        $table->id();
        $table->string('description');
        $table->enum('type', ['income', 'expense', 'reimbursement']);
        $table->decimal('amount', 15, 2);
        $table->date('date');
        $table->string('category')->nullable();
        $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
        $table->string('proof')->nullable(); // bukti transfer/nota
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
