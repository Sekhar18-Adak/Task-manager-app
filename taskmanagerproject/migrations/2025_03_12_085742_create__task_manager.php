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
        Schema::create('_task_manager', function (Blueprint $table) {
            $table->id();
            $table->string('Task_Description');
            $table->string('Task_Owner');
            $table->string('Task_Owner_Email');
            $table->string('Task_Eta');
            $table->boolean('Task_Status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_task_manager');
    }
};
