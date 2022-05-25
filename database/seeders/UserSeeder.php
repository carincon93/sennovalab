<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombres' => 'Admin',
            'apellidos' => 'System',
            'email' => 'adminsennovalab2022@yopmail.com',
            'password' => Hash::make('admin123'),
            'tipoDocumento' => 'cc',
            'numeroDocumento' => '10000000',
            'celular' => '3000000000',
            'estado' => 1,
            'autorizacion_tratamiento_datos' => 1
        ]);
    }
}
