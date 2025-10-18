<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Core project info
            $table->string('name')->unique();
            $table->string('env')->nullable()->comment('e.g. production, staging, dev');

            $table->enum('environment',[
                'develop',
                'testing',
                'beta',
                'uat',
                'production',
            ])->default('develop')->comment('Environment');

            // Redis connection settings
            $table->string('redis_host');
            $table->unsignedSmallInteger('redis_port')->default(6379);
            $table->string('redis_password')->nullable();
            $table->unsignedTinyInteger('redis_db')->default(0);
            $table->string('horizon_prefix')->default('horizon');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
