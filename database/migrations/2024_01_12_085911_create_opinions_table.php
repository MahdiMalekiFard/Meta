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
        Schema::create('opinions', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('published')->default(BooleanEnum::DISABLE->value);
            $table->string('part')->nullable();
            $table->unsignedTinyInteger('star')->default(5);
            $table->text('languages')->nullable(); //['fa','en']
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opinions');
    }
};
