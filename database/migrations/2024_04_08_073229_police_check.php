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
        Schema::create('police_check', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('image')->nullable(); 
            $table->integer('user_id')->nullable();
            $table->integer('status')->default('0')->comment('if status 1 approve , 2 means reject');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('police_check');
    }
};
