<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipologia extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipologias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome'
    ];
}
