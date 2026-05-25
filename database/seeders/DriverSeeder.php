<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Driver;
use App\Models\DeliveryCenter;

class DriverSeeder extends Seeder
{
    public function run(): void
    {
        $centers = DeliveryCenter::all();
        $centerIds = $centers->pluck('id')->toArray();

        $names = ['Ramesh', 'Suresh', 'Amit', 'Rajesh', 'Vikram', 'Prakash', 'Sanjay', 'Rahul', 'Arjun', 'Vijay'];
        foreach ($names as $name) {
            Driver::create([
                'name' => $name . ' Kumar',
                'email' => strtolower($name) . rand(10, 99) . '@flashin.com',
                'phone' => '98' . rand(10000000, 99999999),
                'license_number' => 'DL-' . rand(1000, 9999),
                'vehicle_type' => ['Bike', 'Scooter', 'EV'][rand(0, 2)],
                'status' => 'active',
                'delivery_center_id' => !empty($centerIds) ? $centerIds[array_rand($centerIds)] : null,
            ]);
        }
    }
}

