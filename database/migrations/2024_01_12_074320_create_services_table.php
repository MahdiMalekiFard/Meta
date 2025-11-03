<?php

use App\Enums\BooleanEnum;
use App\Enums\EstatePurposeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique()->index();
            $table->string('key')->unique();
            $table->text('languages')->nullable(); //['fa','en']
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
        Schema::dropIfExists('services');
    }
};
