<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Modules\Integration\Models\Integration;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_connections', function (Blueprint $table) {
            $table->id();
            $table->enum('db_type', ['mysql', 'mongodb'])->default('mysql');
            $table->string('db_host');
            $table->integer('db_port')->default(3306);
            $table->string('db_name');
            $table->string('db_username');
            $table->text('db_password')->nullable();

            $table->foreignIdFor(Integration::class)->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_connections');
    }
};
