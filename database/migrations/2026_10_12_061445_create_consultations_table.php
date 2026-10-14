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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('company_or_institution')->nullable();
            $table->string('service_type'); // Setting Baru, Optimasi Jaringan, Failover, VPN, Hotspot, Maintenance
            $table->string('mikrotik_model')->nullable();
            $table->string('isp_count')->nullable(); // 1 ISP, 2 ISP, dll
            $table->text('problem_description');
            $table->string('status')->default('baru'); // baru, diproses, selesai, dibatalkan
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
