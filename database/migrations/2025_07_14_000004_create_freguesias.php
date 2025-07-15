<?php

use App\Models\Concelho;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('freguesias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->foreignIdFor(Concelho::class)->constrained();
        });

        DB::statement("CREATE VIEW freguesias_view AS
            SELECT f.id, f.nome || ' (' || c.nome || ')' AS 'nome'
            FROM freguesias f
            INNER JOIN concelhos c ON c.id = f.concelho_id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freguesias');

        DB::statement("DROP VIEW freguesias_view;");
    }
};
