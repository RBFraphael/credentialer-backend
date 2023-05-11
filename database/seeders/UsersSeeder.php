<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // Admins
            [
                'name' => "Raphael Batista",
                'email' => "raphael.batista@newton.ag",
                'password' => "New@2023",
                'role' => UserRole::ADMIN
            ],
            [
                'name' => "Maicon Mendonça",
                'email' => "maicon.mendonca@newton.ag",
                'password' => "New@2023",
                'role' => UserRole::ADMIN
            ],
            [
                'name' => "Victor Lima",
                'email' => "victor@newton.ag",
                'password' => "New@2023",
                'role' => UserRole::ADMIN
            ],

            // Managers
            [
                'name' => "Ellen Medeiros",
                'email' => "ellen.medeiros@newton.ag",
                'password' => "New@2023",
                'role' => UserRole::MANAGER
            ],
            [
                'name' => "Márcia Pereira",
                'email' => "marcia.pereira@newton.ag",
                'password' => "New@2023",
                'role' => UserRole::MANAGER
            ],
            [
                'name' => "Viviana Del Bianco",
                'email' => "viviana.delbianco@newton.ag",
                'password' => "New@2023",
                'role' => UserRole::MANAGER
            ],

            // Developers
            [
                'name' => "Alexandre Yokota",
                'email' => "alexandre.yokota@newton.ag",
                'password' => "New@2023",
                'role' => UserRole::DEVELOPER
            ],
            [
                'name' => "Danilo Gameiro",
                'email' => "danilo.gameiro@newton.ag",
                'password' => "New@2023",
                'role' => UserRole::DEVELOPER
            ],
            [
                'name' => "Elias Rebequi",
                'email' => "elias.rebequi@newton.ag",
                'password' => "New@2023",
                'role' => UserRole::DEVELOPER
            ],
            [
                'name' => "Francisco Assis",
                'email' => "francisco.assis@newton.ag",
                'password' => "New@2023",
                'role' => UserRole::DEVELOPER
            ],
            [
                'name' => "Guilherme Henrique",
                'email' => "guilherme.henrique@newton.ag",
                'password' => "New@2023",
                'role' => UserRole::DEVELOPER
            ],
            [
                'name' => "Gustavo Alves",
                'email' => "gustavo.alves@newton.ag",
                'password' => "New@2023",
                'role' => UserRole::DEVELOPER
            ]
        ];

        foreach($users as $userData){
            $user = new User($userData);
            $user->save();
        }
    }
}
