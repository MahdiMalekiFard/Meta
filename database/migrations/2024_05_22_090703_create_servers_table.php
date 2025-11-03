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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique()->index();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('website_url')->nullable()->unique()->index();
            $table->string('domain_name')->unique()->index();
            $table->string('ip_address')->nullable()->unique()->index();
            $table->boolean('has_ssl')->default(true);
            $table->boolean('has_backup')->default(true);
            $table->unsignedInteger('backup_frequency')->default(1)->comment('in hours');
            $table->boolean('has_application')->default(false);
            $table->boolean('has_website')->default(false);
            $table->timestamp('application_updated_at')->nullable();
            $table->timestamp('source_code_updated_at')->nullable();
            $table->string('database_password')->nullable();
            $table->string('ssh_password')->nullable();
            $table->date('expired_at');
            $table->softDeletes();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
