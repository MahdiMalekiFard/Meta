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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique()->index();
            $table->text('languages')->nullable(); //['fa','en']
            $table->schemalessAttributes('extra_attributes');
            $table->softDeletes();
            $table->morphs('planable');
            $table->unsignedBigInteger('limit')->default(0);
            $table->timestamps();
            $table->unique(['planable_id', 'planable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
