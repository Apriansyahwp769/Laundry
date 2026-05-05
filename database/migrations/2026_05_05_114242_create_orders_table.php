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
      Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->string('order_number')->unique();

    $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
    $table->foreignId('assigned_staff_id')->nullable()->constrained('users')->nullOnDelete();
    $table->foreignId('service_id')->constrained()->cascadeOnDelete();

    $table->enum('status', ['waiting','washing','ironing','ready','delivered','cancelled'])->default('waiting');

    $table->integer('progress_percentage')->default(0);

    $table->decimal('total_weight', 10, 2);
    $table->decimal('total_price', 12, 2);

    $table->text('notes')->nullable();

    $table->dateTime('estimated_completion');
    $table->dateTime('completed_at')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
