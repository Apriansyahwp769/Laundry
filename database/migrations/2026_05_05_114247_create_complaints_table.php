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
      Schema::create('complaints', function (Blueprint $table) {
    $table->id();
    $table->string('ticket_number')->unique();

    $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
    $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();

    $table->enum('category', ['luntur','tertukar','hilang','kualitas','kerusakan','lainnya']);
    $table->enum('priority', ['low','medium','high'])->default('low');
    $table->enum('status', ['new','investigating','resolved','rejected'])->default('new');

    $table->text('description');
    $table->text('resolution_note')->nullable();

    $table->foreignId('resolved_by')->nullable()->constrained('users')->nullOnDelete();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
