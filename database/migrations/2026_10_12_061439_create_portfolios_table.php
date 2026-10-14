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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client_name');
            $table->string('category'); // e.g. Kantor, Hotel, Cafe/Resto, RT/RW Net, Sekolah
            $table->string('location')->nullable();
            $table->text('summary');
            $table->longText('challenge')->nullable();
            $table->longText('solution')->nullable();
            $table->longText('result')->nullable();
            $table->string('device_used')->nullable(); // e.g. CCR2004, RB4011, hEX
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
