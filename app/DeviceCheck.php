<?php

namespace App;

use App\Models\Device;

class DeviceCheck
{
    public function run(int $deviceId): void
    {
        $device = Device::findOrFail($deviceId);

        if ($device->last_seen_at === null) {
            $device->status = 'unknown';
        } elseif ($device->last_seen_at->lte(now()->subSeconds(30))) {
            $device->status = 'offline';
        } else {
            $device->status = 'online';
        }

        $device->last_checked_at = now();
        $device->save();
    }
}
