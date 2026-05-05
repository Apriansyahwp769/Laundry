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
       Schema::create('services', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();

    $table->enum('unit', ['kg','pc','item']);

    $table->decimal('base_price', 12, 2);
    $table->decimal('surcharge', 12, 2)->default(0);

    $table->text('description')->nullable();
    $table->boolean('is_active')->default(true);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
