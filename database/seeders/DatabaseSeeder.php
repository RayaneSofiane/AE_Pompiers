<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\State;
use App\Models\FireStation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create states
        $states = [
            ['description' => 'Active'],
            ['description' => 'Inactive'],
            ['description' => 'Under Maintenance'],
            ['description' => 'Emergency Response'],
        ];

        foreach ($states as $state) {
            State::create($state);
        }

        // Create sample fire stations
        $stations = [
            [
                'name' => 'Central Fire Station Montreal',
                'address' => '123 Rue Saint-Paul',
                'city' => 'Montreal',
                'phone' => '514-555-0001',
                'id_state' => 1,
            ],
            [
                'name' => 'Downtown Fire Station',
                'address' => '456 Boulevard de Maisonneuve',
                'city' => 'Montreal',
                'phone' => '514-555-0002',
                'id_state' => 1,
            ],
            [
                'name' => 'Quebec City Fire Station',
                'address' => '789 Rue de la Couronne',
                'city' => 'Quebec City',
                'phone' => '418-555-0001',
                'id_state' => 1,
            ],
            [
                'name' => 'Laval Fire Station',
                'address' => '321 Avenue Saint-Martin',
                'city' => 'Laval',
                'phone' => '450-555-0001',
                'id_state' => 2,
            ],
            [
                'name' => 'Gatineau Fire Station',
                'address' => '654 Boulevard de la Gatineau',
                'city' => 'Gatineau',
                'phone' => '819-555-0001',
                'id_state' => 3,
            ],
        ];

        foreach ($stations as $station) {
            FireStation::create($station);
        }
    }
}
