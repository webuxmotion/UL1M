<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category'); // e.g., Microcontroller, Sensor, Motor, Tool, etc.
            $table->string('manufacturer')->nullable();
            $table->string('part_number')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2)->nullable();
            $table->foreignId('workshop_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->index(['name', 'workshop_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
