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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('category_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('venue');
            $table->date('event_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('organizer');
            $table->integer('max_capacity');
            $table->enum('status', [
                'Upcoming',
                'Ongoing',
                'Completed',
                'Cancelled'
            ])->default('Upcoming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
