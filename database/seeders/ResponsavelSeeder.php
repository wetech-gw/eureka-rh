<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResponsavelSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'sidiainquade@gmail.com'],
            [
                'name'     => 'Sidia Inquade',
                'password' => Hash::make('sidia1992'),
                'role'     => 'Responsável',
		
             
            ]
        );
    }
}
