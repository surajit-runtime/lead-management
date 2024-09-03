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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audience_id')
                ->constrained()
                ->onDelete('cascade');
            $table->dateTime('date'); // Date and time
            $table->enum('channel', ['email', 'whatsapp', 'sms']);
            $table->string('subject');
            $table->longText('body'); // Use longText for longer text content
            $table->boolean('flag')->default(0);
            $table->boolean('success_status')->default(0);
            $table->timestamps();
            $table->softDeletes(); // Optional: if you want to use soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
