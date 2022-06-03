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
            'primer_nombre'                     => 'Admin',
            'primer_apellido'                   => 'System',
            'email'                             => 'admin@mail.com',
            'password'                          => Hash::make('admin123'),
            'tipo_documento'                    => 'cc',
            'numero_documento'                  => '10000000',
            'celular'                           => '3000000000',
            'telefono'                          => '8888888-8888889',
            'estado'                            => 1,
            'autorizacion_tratamiento_datos'    => 1
        ]);
    }
}
