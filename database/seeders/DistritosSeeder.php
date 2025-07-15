<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistritosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('distritos')->insert(['id' => 1, 'nome' => 'Aveiro']);
        DB::table('distritos')->insert(['id' => 2, 'nome' => 'Beja']);
        DB::table('distritos')->insert(['id' => 3, 'nome' => 'Braga']);
        DB::table('distritos')->insert(['id' => 4, 'nome' => 'Bragança']);
        DB::table('distritos')->insert(['id' => 5, 'nome' => 'Castelo Branco']);
        DB::table('distritos')->insert(['id' => 6, 'nome' => 'Coimbra']);
        DB::table('distritos')->insert(['id' => 7, 'nome' => 'Évora']);
        DB::table('distritos')->insert(['id' => 8, 'nome' => 'Faro']);
        DB::table('distritos')->insert(['id' => 9, 'nome' => 'Guarda']);
        DB::table('distritos')->insert(['id' => 10, 'nome' => 'Leiria']);
        DB::table('distritos')->insert(['id' => 11, 'nome' => 'Lisboa']);
        DB::table('distritos')->insert(['id' => 12, 'nome' => 'Portalegre']);
        DB::table('distritos')->insert(['id' => 13, 'nome' => 'Porto']);
        DB::table('distritos')->insert(['id' => 14, 'nome' => 'Santarém']);
        DB::table('distritos')->insert(['id' => 15, 'nome' => 'Setúbal']);
        DB::table('distritos')->insert(['id' => 16, 'nome' => 'Viana do Castelo']);
        DB::table('distritos')->insert(['id' => 17, 'nome' => 'Vila Real']);
        DB::table('distritos')->insert(['id' => 18, 'nome' => 'Viseu']);
        DB::table('distritos')->insert(['id' => 31, 'nome' => 'Ilha da Madeira']);
        DB::table('distritos')->insert(['id' => 32, 'nome' => 'Ilha de Porto Santo']);
        DB::table('distritos')->insert(['id' => 41, 'nome' => 'Ilha de Santa Maria']);
        DB::table('distritos')->insert(['id' => 42, 'nome' => 'Ilha de São Miguel']);
        DB::table('distritos')->insert(['id' => 43, 'nome' => 'Ilha Terceira']);
        DB::table('distritos')->insert(['id' => 44, 'nome' => 'Ilha da Graciosa']);
        DB::table('distritos')->insert(['id' => 45, 'nome' => 'Ilha de São Jorge']);
        DB::table('distritos')->insert(['id' => 46, 'nome' => 'Ilha do Pico']);
        DB::table('distritos')->insert(['id' => 47, 'nome' => 'Ilha do Faial']);
        DB::table('distritos')->insert(['id' => 48, 'nome' => 'Ilha das Flores']);
        DB::table('distritos')->insert(['id' => 49, 'nome' => 'Ilha do Corvo']);
    }
}
