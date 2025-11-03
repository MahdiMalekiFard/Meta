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
        Schema::create('plan_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('month')->default(1);
            $table->unsignedTinyInteger('type');//PlanTypeEnum::class
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('price_special')->default(0);
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_pricings');
    }
};
