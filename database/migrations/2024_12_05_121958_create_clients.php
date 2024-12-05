<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();  // Store the logo image
            $table->date('contract_date');      // Contract date
            $table->json('selected_module')->nullable();
            $table->enum('module_type', ['Legal Pro', 'Mail Pro', 'Visit Pro'])->nullable();

            $table->string('key');
            $table->json('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
