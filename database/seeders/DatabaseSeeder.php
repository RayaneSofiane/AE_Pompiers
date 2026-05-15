<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\State;
use App\Models\FireStation;
use App\Models\InterventionType;
use App\Models\InterventionRecord;
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

        // Create sample intervention types
        $interventionTypes = [
            [
                'no_intervention' => 'FIRE-AUTO',
                'description' => 'Automobile Fire - Vehicle fire response',
            ],
            [
                'no_intervention' => 'FIRE-STRUCT',
                'description' => 'Structure Fire - Building or house fire',
            ],
            [
                'no_intervention' => 'MED-EMERG',
                'description' => 'Medical Emergency - First aid and ambulance transport',
            ],
            [
                'no_intervention' => 'RESCUE-ACC',
                'description' => 'Rescue - Traffic accident and extrication',
            ],
            [
                'no_intervention' => 'HAZMAT',
                'description' => 'Hazardous Materials - Spill and contamination response',
            ],
        ];

        foreach ($interventionTypes as $type) {
            InterventionType::create($type);
        }

        // Create sample intervention records
        $interventionRecords = [
            [
                'date_time_start' => '2024-01-15 14:30:00',
                'address' => '123 Rue Saint-Paul, Montreal, QC',
                'summary' => 'Car fire on highway. Vehicle fully engulfed. Extinguished with foam. No injuries. Vehicle total loss.',
                'id_type_intervention' => 1,
                'id_fire_station' => 1,
            ],
            [
                'date_time_start' => '2024-01-16 09:15:00',
                'address' => '456 Boulevard de Maisonneuve, Montreal, QC',
                'summary' => 'Residential fire in 3-story building. Quick response prevented spread. One resident evacuated safely. Cause under investigation.',
                'id_type_intervention' => 2,
                'id_fire_station' => 2,
            ],
            [
                'date_time_start' => '2024-01-17 18:45:00',
                'address' => '789 Rue de la Couronne, Quebec City, QC',
                'summary' => 'Medical emergency - elderly person with chest pain. Paramedics provided oxygen and monitoring. Patient transported to hospital.',
                'id_type_intervention' => 3,
                'id_fire_station' => 3,
            ],
            [
                'date_time_start' => '2024-01-18 22:30:00',
                'address' => '321 Avenue Saint-Martin, Laval, QC',
                'summary' => 'Multi-vehicle collision on Autoroute 15. Two vehicles. One driver trapped. Extrication performed. Two patients transported.',
                'id_type_intervention' => 4,
                'id_fire_station' => 4,
            ],
            [
                'date_time_start' => '2024-01-19 11:00:00',
                'address' => '654 Boulevard de la Gatineau, Gatineau, QC',
                'summary' => 'Chemical spill at industrial facility. 500 liters of unknown chemical. Area cordoned off. HAZMAT team called. No injuries.',
                'id_type_intervention' => 5,
                'id_fire_station' => 5,
            ],
            [
                'date_time_start' => '2024-01-20 16:20:00',
                'address' => '111 Avenue des Pins, Montreal, QC',
                'summary' => 'Apartment fire - smoke alarm activated by early detection. Fire contained to kitchen. Damage minimal. Family safe outside.',
                'id_type_intervention' => 2,
                'id_fire_station' => 1,
            ],
            [
                'date_time_start' => '2024-01-21 08:00:00',
                'address' => '222 Chemin Sainte-Foy, Quebec City, QC',
                'summary' => 'Medical call - diabetic crisis. Patient conscious and responsive. Blood sugar monitored and adjusted at scene.',
                'id_type_intervention' => 3,
                'id_fire_station' => 3,
            ],
            [
                'date_time_start' => '2024-01-22 13:45:00',
                'address' => '333 Rue Masson, Montreal, QC',
                'summary' => 'Two-car collision on residential street. Minor injuries only. Both drivers lucid and cooperative. Police attended.',
                'id_type_intervention' => 4,
                'id_fire_station' => 2,
            ],
            [
                'date_time_start' => '2024-01-23 19:30:00',
                'address' => '444 Boulevard Pie-IX, Montreal, QC',
                'summary' => 'Truck fire on bridge. Driver exited safely. Fire spread to cargo. Used water and foam. Bridge temporarily closed.',
                'id_type_intervention' => 1,
                'id_fire_station' => 1,
            ],
            [
                'date_time_start' => '2024-01-24 10:15:00',
                'address' => '555 Rue King, Laval, QC',
                'summary' => 'Warehouse fire - partial collapse of roof. Fire services coordinated with police. No personnel on site. Cause under investigation.',
                'id_type_intervention' => 2,
                'id_fire_station' => 4,
            ],
        ];

        foreach ($interventionRecords as $record) {
            InterventionRecord::create($record);
        }
    }
}
