<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'registos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'contacto_nome',
        'contacto_empresa',
        'contacto_telefone',
        'contacto_email',
        'caracterizacao_nome',
        'caracterizacao_nif',
        'caracterizacao_distrito',
        'caracterizacao_concelho',
        'caracterizacao_tipo',
        'caracterizacao_empresa_mais_dois_anos',
        'caracterizacao_grande_empresa',
        'caracterizacao_sector',
        'caracterizacao_cae',
        'projeto_designacao',
        'projeto_distrito',
        'projeto_concelho',
        'projeto_freguesia',
        'projeto_tipologia',
        'projeto_custo',
        'descricao'
    ];
}
