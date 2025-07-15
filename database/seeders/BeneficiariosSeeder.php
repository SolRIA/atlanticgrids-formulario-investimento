<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeneficiariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('beneficiarios')->insert(['nome' => 'Empresa']);
        DB::table('beneficiarios')->insert(['nome' => 'Particular']);
        DB::table('beneficiarios')->insert(['nome' => 'Entidade pública ou equiparada']);
        DB::table('beneficiarios')->insert(['nome' => 'Entidade sem fins lucrativos']);
        DB::table('beneficiarios')->insert(['nome' => 'IPSS']);
        DB::table('beneficiarios')->insert(['nome' => 'Entidade formadora']);
        DB::table('beneficiarios')->insert(['nome' => 'Outra']);
    }
}
