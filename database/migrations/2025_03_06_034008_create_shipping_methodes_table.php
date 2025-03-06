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
        Schema::create('shipping_methodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_carrier_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('max_length')->nullable();
            $table->integer('max_width')->nullable();
            $table->integer('max_height')->nullable();
            $table->integer('weight');
            $table->decimal('price', 8, 2);
            $table->string('option')->default('none');
            $table->decimal('insurance_value', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_methodes');
    }
};
