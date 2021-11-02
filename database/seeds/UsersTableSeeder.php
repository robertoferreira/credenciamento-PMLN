<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'uuid'                  =>  Str::uuid(),
            'name'                  =>  'Roberto Ferreira',
            'email'                 =>  'roberto@housecriative.com.br',
            'password'              =>  bcrypt('2032Mkyjwb@#'),
            'phone_person'          => '(84) 99818-9508',
            'document_person_owner' =>  '063.432.854-90',
            'birthday'              =>  null,
            'level'                 =>  3,
            'status'                =>  'ativo'
        ]);

        DB::table('users')->insert([
            'uuid'                  =>  Str::uuid(),
            'name'                  =>  'Flavio Cardoso',
            'email'                 =>  'cpl@lagoanova.rn.gov.br',
            'password'              =>  bcrypt('2019Lagoa@#'),
            'phone_person'          => null,
            'document_person_owner' =>  null,
            'birthday'              =>  null,
            'level'                 =>  3,
            'status'                =>  'ativo'
        ]);

    }
}
