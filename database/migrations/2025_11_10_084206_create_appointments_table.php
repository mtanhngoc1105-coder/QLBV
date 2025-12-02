<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // Foreign key patient
            $table->foreignId('patient_id')
                  ->constrained('patients')
                  ->onDelete('cascade');

            // Foreign key doctor
            $table->foreignId('doctor_id')
                  ->constrained('doctors')
                  ->onDelete('cascade');

            // Ngày và giờ khám
            $table->date('date');
            $table->time('time');

            // Status: mở rộng tất cả trạng thái cần thiết
            $table->enum('status', ['pending', 'accepted', 'rejected', 'completed', 'canceled'])
                  ->default('pending');

            // Ghi chú
            $table->string('note', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
