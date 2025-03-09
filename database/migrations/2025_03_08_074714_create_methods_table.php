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
        Schema::create('methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zone_id')->constrained()->cascadeOnDelete();
            $table->foreignId('carrier_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->decimal('min_length', 8, 2)->nullable();;
            $table->decimal('max_length', 8, 2);
            $table->decimal('min_width', 8, 2)->nullable();;
            $table->decimal('max_width', 8, 2);
            $table->decimal('min_height', 8, 2)->nullable();;
            $table->decimal('max_height', 8, 2)->nullable();;
            $table->decimal('min_weight', 8, 2)->nullable();;
            $table->decimal('max_weight', 8, 2);
            $table->decimal('price', 8, 2);
            $table->enum('options', ['none', 'track&trace', 'insurance']);
            $table->decimal('insurance_value', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('methods');
    }
};
