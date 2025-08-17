<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weight_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーと紐付け
            $table->decimal('target_weight', 4, 1); // 目標体重
            $table->date('target_date'); // 目標達成日
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weight_targets');
    }
};