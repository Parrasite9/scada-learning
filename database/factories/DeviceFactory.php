<?php

namespace Database\Factories;

use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Device> */
class DeviceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->bothify('PLC-###-??'),
            'last_seen_at' => null,
            'status' => 'unchecked',
            'last_checked_at' => null,
        ];
    }
}
