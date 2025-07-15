<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipologiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipologias')->insert(['nome' => 'IDT']);
        DB::table('tipologias')->insert(['nome' => 'Criação de núcleo de I&D']);
        DB::table('tipologias')->insert(['nome' => 'Criação de novo estabelecimento']);
        DB::table('tipologias')->insert(['nome' => 'Requalificação hoteleira']);
        DB::table('tipologias')->insert(['nome' => 'Aumento de capacidade do estabelecimento']);
        DB::table('tipologias')->insert(['nome' => 'Diversificação dos produtos/serviços disponibilizados']);
        DB::table('tipologias')->insert(['nome' => 'Prospeção e presença em mercados internacionais']);
        DB::table('tipologias')->insert(['nome' => 'Estudos']);
        DB::table('tipologias')->insert(['nome' => 'Formação/Educação']);
        DB::table('tipologias')->insert(['nome' => 'Eficiência energética']);
        DB::table('tipologias')->insert(['nome' => 'Mobilidade sustentável']);
        DB::table('tipologias')->insert(['nome' => 'Património natural e cultural']);
        DB::table('tipologias')->insert(['nome' => 'Regeneração e ambiente urbano']);
        DB::table('tipologias')->insert(['nome' => 'Valorização de recursos endógenos']);
        DB::table('tipologias')->insert(['nome' => 'Emprego']);
        DB::table('tipologias')->insert(['nome' => 'Inclusão social']);
        DB::table('tipologias')->insert(['nome' => 'TIC']);
        DB::table('tipologias')->insert(['nome' => 'Capacitação']);
        DB::table('tipologias')->insert(['nome' => 'Ciclo urbano da água']);
        DB::table('tipologias')->insert(['nome' => 'Resíduos']);
        DB::table('tipologias')->insert(['nome' => 'Economia circular']);
        DB::table('tipologias')->insert(['nome' => 'Infraestruturas de educação']);
        DB::table('tipologias')->insert(['nome' => 'Infraestruturas de saúde']);
        DB::table('tipologias')->insert(['nome' => 'Adaptação às alterações climáticas']);
        DB::table('tipologias')->insert(['nome' => 'Corredores verdes']);
        DB::table('tipologias')->insert(['nome' => 'Proteção civil']);
        DB::table('tipologias')->insert(['nome' => 'Outros']);
    }
}
