<?php

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique()->index();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->double('total_price')->default(0);
            $table->double('discount_price')->default(0);
            $table->text('note')->nullable();
            $table->string('status')->default(OrderStatusEnum::PENDING->value);
            $table->timestamp('expired_at')->nullable();
            $table->foreignId('canceled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('paid_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('payment_method')->nullable();
            $table->boolean('repeatable')->default(false);
            $table->schemalessAttributes('extra_attributes');
            $table->softDeletes();
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
