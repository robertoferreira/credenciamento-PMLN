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
            'phone_person'          => null,
            'document_person_owner' =>  null,
            'birthday'              =>  null,
            'level'                 =>  3,
            'status'                =>  'ativo'
        ]);
    }
}
