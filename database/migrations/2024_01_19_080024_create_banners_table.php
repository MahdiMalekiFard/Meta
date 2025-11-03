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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->text('link')->nullable();
            $table->string('button')->nullable();
            $table->string('gravity')->nullable();
            $table->integer('click')->default(0);
            $table->integer('limit')->default(0);
            $table->boolean('published')->default(BooleanEnum::DISABLE->value);
            $table->timestamp('expire_at')->nullable();
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
        Schema::dropIfExists('banners');
    }
};
