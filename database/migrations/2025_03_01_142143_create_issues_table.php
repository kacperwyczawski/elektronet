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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('room');
            $table->string('description');
            $table->foreignId('created_by_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->integer('priority')
                ->default(2);
            $table->foreignId('assigned_to_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
            $table->boolean('is_approved')
                ->default(false);
            $table->boolean('is_done')
                ->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
