<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('type', ['dark_store', 'warehouse', 'grocery_store'])->default('dark_store');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_centers');
    }
};
