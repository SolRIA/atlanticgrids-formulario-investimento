<?php

use App\Models\Distrito;
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
        Schema::create('concelhos', function (Blueprint $table) {
            // don't want to create auto incremente primary key
            $table->integer('id')->primary();
            $table->string('nome');
            $table->foreignIdFor(Distrito::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concelhos');
    }
};
