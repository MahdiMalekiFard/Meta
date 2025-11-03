<?php

use App\Enums\BooleanEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activation_codes', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index()->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('code', 10);
            $table->boolean('used')->default(BooleanEnum::DISABLE->value);
            $table->timestamp('expire_at');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activation_codes');
    }
};
