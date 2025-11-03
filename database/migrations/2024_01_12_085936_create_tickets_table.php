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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique()->index();
            $table->string('subject');
            $table->text('description');
            $table->string('department');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('closed_by')->nullable()->constrained('users');
            $table->string('status')->default('open');
            $table->string('priority')->default('normal');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
