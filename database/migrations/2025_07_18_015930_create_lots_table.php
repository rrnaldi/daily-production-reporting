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
        Schema::create('lots', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique();
        $table->foreignId('item_id')->constrained()->onDelete('restrict');
        $table->foreignId('uom_id')->constrained()->onDelete('restrict');
        $table->decimal('qty_awal', 10, 2);
        $table->decimal('qty_sisa', 10, 2);
        $table->date('expired_at')->nullable();
        $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lots');
    }
};
