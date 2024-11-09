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
        Schema::create('client_governorates', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('client_id'); // Ensure this matches clients.id type
//            $table->unsignedBigInteger('governorate_id'); // Ensure this matches governorates.id type
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('governorate_id')->constrained('governorates')->onDelete('cascade');
            $table->timestamps();

//            // Foreign key constraints
//            $table->foreign('client_id')
//                ->references('id')->on('clients')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//
//            $table->foreign('governorate_id')
//                ->references('id')->on('governorates')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_governorates');
    }
};
