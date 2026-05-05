<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Cuci Kiloan',
                'slug' => 'cuci-kiloan',
                'unit' => 'kg',
                'base_price' => 8000,
                'surcharge' => 0,
                'description' => 'Standard wash & fold service per kilogram.',
                'is_active' => true,
            ],
            [
                'name' => 'Cuci Satuan',
                'slug' => 'cuci-satuan',
                'unit' => 'pc',
                'base_price' => 25000,
                'surcharge' => 0,
                'description' => 'Premium individual item care (dry clean/press).',
                'is_active' => true,
            ],
            [
                'name' => 'Layanan Kilat',
                'slug' => 'layanan-kilat',
                'unit' => 'item',
                'base_price' => 15000,
                'surcharge' => 15000,
                'description' => 'Express same-day service surcharge.',
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }
    }
}