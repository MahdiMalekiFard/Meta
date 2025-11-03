<?php

use App\Enums\BooleanEnum;
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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index()->unique();
            $table->string('slug')->unique()->index();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('published')->default(BooleanEnum::DISABLE->value);
            $table->unsignedBigInteger('total_view')->default(0);
            $table->unsignedBigInteger('total_comment')->default(0);
            $table->unsignedBigInteger('total_like')->default(0);
            $table->text('languages')->nullable(); //['fa','en']
            $table->schemalessAttributes('extra_attributes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
