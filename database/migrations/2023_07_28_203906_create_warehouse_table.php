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
        Schema::create('warehouse', function (Blueprint $table) {
            $table->id();
            $table->string('customer'); // Change 'customer()' to 'string()'
            $table->string('type');     // Change 'type()' to 'string()'
            $table->string('measure');  // Change 'measure()' to 'string()'
            $table->decimal('amount');  // Change 'amount()' to 'decimal()'
            // Add other columns as needed
            $table->timestamps(); // Example: Add created_at and updated_at columns
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse');
    }
};
