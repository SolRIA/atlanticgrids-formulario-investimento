<?php

use App\Models\Beneficiario;
use App\Models\Concelho;
use App\Models\Distrito;
use App\Models\Freguesia;
use App\Models\Tipologia;
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
        Schema::create('registos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('contacto_nome');
            $table->string('contacto_empresa');
            $table->string('contacto_telefone');
            $table->string('contacto_email');
            $table->text('caracterizacao_nome');
            $table->string('caracterizacao_nif');
            $table->foreignIdFor(Distrito::class, 'caracterizacao_distrito')->constrained();
            $table->foreignIdFor(Concelho::class, 'caracterizacao_concelho')->constrained();
            $table->foreignIdFor(Beneficiario::class, 'caracterizacao_tipo')->constrained();
            $table->boolean('caracterizacao_empresa_mais_dois_anos');
            $table->boolean('caracterizacao_grande_empresa');
            $table->string('caracterizacao_sector');
            $table->string('caracterizacao_cae');
            $table->string('projeto_designacao');
            $table->foreignIdFor(Distrito::class, 'projeto_distrito')->constrained();
            $table->foreignIdFor(Concelho::class, 'projeto_concelho')->constrained();
            $table->foreignIdFor(Freguesia::class, 'projeto_freguesia')->constrained();
            $table->foreignIdFor(Tipologia::class, 'projeto_tipologia')->constrained();
            $table->double('projeto_custo');
            $table->text('descricao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registos');
    }
};
