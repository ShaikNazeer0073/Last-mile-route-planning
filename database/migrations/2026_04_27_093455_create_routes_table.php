<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('route_name');
            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
            $table->string('start_location');
            $table->string('end_location');
            $table->decimal('start_lat', 10, 6)->nullable();
            $table->decimal('start_lng', 10, 6)->nullable();
            $table->decimal('end_lat', 10, 6)->nullable();
            $table->decimal('end_lng', 10, 6)->nullable();
            $table->decimal('estimated_distance', 8, 2)->nullable();
            $table->string('estimated_time')->nullable();
            $table->enum('status', ['planned', 'active', 'completed'])->default('planned');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
