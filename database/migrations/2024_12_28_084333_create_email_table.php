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
        Schema::create('emails', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('subject');
            $table->text('body');
            $table->string('status')->default('draft'); // e.g., draft, sent
            $table->timestamp('date')->nullable();
            $table->string('attachment')->nullable(); // File path for attachments
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Sender
            $table->timestamps(); // Created at & Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email');
    }
};
