<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'Administrador',
            'type' => 'interno',
            'guard_name' => 'web',
            'description' => 'Administrador del sistema'
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'Calidad',
            'type' => 'interno',
            'guard_name' => 'web',
            'description' => 'Coordinador de Calidad Sennovalab'
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'Empresa',
            'type' => 'externo',
            'guard_name' => 'web',
            'description' => 'Usuario empresa'
        ]);

        DB::table('roles')->insert([
            'id' => 4,
            'name' => 'investigador',
            'type' => 'interno',
            'guard_name' => 'web',
            'description' => 'Usuario externo'
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_id' => 1,
            'model_type' => 'App\Models\User'
        ]);
    }
}
