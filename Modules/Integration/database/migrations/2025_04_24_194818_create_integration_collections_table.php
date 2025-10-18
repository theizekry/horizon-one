<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('integration_collections', function (Blueprint $table) {
            $table->id();
            $table->string('alias');

            $table->foreignId('integration_id')->constrained('integrations')->onDelete('cascade');
            $table->foreignId('system_collection_id')->constrained('system_collections')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integration_collections');
    }
};
