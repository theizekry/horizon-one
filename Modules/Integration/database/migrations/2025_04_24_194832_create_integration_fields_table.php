<?php

use Illuminate\Support\Facades\Schema;
use Modules\Integration\Enums\FieldType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('integration_fields', function (Blueprint $table) {
            $table->id();
            $table->string('alias');
            $table->tinyInteger('type')->default(FieldType::DIRECT);
            $table->json('config')->nullable();

            $table->foreignId('integration_collection_id')->constrained('integration_collections')->cascadeOnDelete();
            $table->foreignId('system_field_id')->constrained('system_fields')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integration_fields');
    }
};
