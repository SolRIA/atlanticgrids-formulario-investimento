<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Concelho;
use App\Models\Distrito;
use App\Models\Registo;
use App\Models\Tipologia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormularioController extends Controller
{
    public function registo(Request $request)
    {
        // validate the request
        $attributes = $request->validate([
            'contacto_nome' => 'required|string',
            'contacto_empresa' => 'nullable|string|max:255',
            'contacto_telefone' => 'nullable|string|max:255',
            'contacto_email' => 'required|string|max:255',
            'caracterizacao_nome' => 'nullable|string|max:255',
            'caracterizacao_nif' => 'nullable|string|max:255',
            'caracterizacao_distrito' => 'nullable|integer',
            'caracterizacao_concelho' => 'nullable|integer',
            'caracterizacao_tipo' => 'required|integer',
            'caracterizacao_empresa_mais_dois_anos' => 'required|boolean',
            'caracterizacao_grande_empresa' => 'nullable|boolean',
            'caracterizacao_sector' => 'required|string',
            'caracterizacao_cae' => 'nullable|string',
            'projeto_designacao' => 'nullable|string',
            'projeto_distrito' => 'nullable|integer',
            'projeto_concelho' => 'nullable|integer',
            'projeto_freguesia' => 'nullable|integer',
            'projeto_tipologia' => 'required|integer',
            'projeto_custo' => 'nullable|double',
            'descricao' => 'required|string',
        ]);

        // create a new record
        Registo::create($attributes);

        return redirect('home');
    }

    public function beneficiarios()
    {
        $records = Beneficiario::get();

        return response()->json($records);
    }

    public function tipologias()
    {
        $records = Tipologia::get();

        return response()->json($records);
    }

    public function distritos(Request $request)
    {
        $query = Distrito::select('id', 'nome');

        if ($request->has('c') && $request->c != '') {
            $query->where(function ($q) use ($request) {
                return $q
                    ->where('nome', 'LIKE', "{$request->c}%");
            });
        }

        $records = $query
            ->orderBy('nome', 'asc')
            ->get();

        Log::debug(json_encode($records));

        return response()->json($records);
    }

    public function concelhos(Request $request)
    {
        if ($request->has('d') == false) return response(json_encode([]));

        $records = Concelho::select('id', 'nome')
            ->where('distrito_id', $request->d)
            ->orderBy('nome', 'asc')
            ->get();

        return response()->json($records);
    }

    public function freguesias(Request $request)
    {
        if ($request->has('n') == false) return response(json_encode([]));

        $records = DB::table('freguesias_view')
            ->where('nome', 'LIKE', $request->n . '%')
            ->orderBy('nome', 'asc')
            ->get();

        return response()->json($records);
    }
}
