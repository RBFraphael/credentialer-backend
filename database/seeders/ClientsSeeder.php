<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [ 'name' => "Doptex" ],
            [ 'name' => "Éobox" ],
            [ 'name' => "Esfera Energia" ],
            [ 'name' => "Febrasgo" ],
            [ 'name' => "iFood" ],
            [ 'name' => "Maximiza" ],
            [ 'name' => "Momentum" ],
            [ 'name' => "Newton" ],
            [ 'name' => "Omint" ],
            [ 'name' => "Porte" ],
            [ 'name' => "Prefeitura Rio Claro" ],
            [ 'name' => "Sementes NK" ]
        ];

        foreach($clients as $clientData){
            $client = new Client($clientData);
            $client->save();
        }
    }
}
