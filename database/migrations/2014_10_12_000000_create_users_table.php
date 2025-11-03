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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index()->unique();
            $table->string('name')->nullable();
            $table->string('family')->nullable();
            $table->boolean('status')->default(BooleanEnum::ENABLE->value);
            $table->string('mobile',15)->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('email',100)->nullable()->unique();
            $table->string('google_id')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
