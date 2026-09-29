<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Device::firstOrCreate(['name' => 'Pump PLC']);
        Device::firstOrCreate(['name' => 'Tank sensor']);
        Device::firstOrCreate(['name' => 'Conveyor PLC']);
    }
}
