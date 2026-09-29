<?php

namespace Tests\Feature;

use App\DeviceCheck;
use App\Models\Device;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeviceCheckTest extends TestCase
{
    use RefreshDatabase;

    public function test_check_saves_unknown_without_a_heartbeat(): void
    {
        $this->freezeSecond();
        $device = Device::factory()->create();
        (new DeviceCheck)->run($device->id);
        $device->refresh();

        $this->assertSame('unknown', $device->status);
        $this->assertTrue($device->last_checked_at->equalTo(now()));
    }

    public function test_fresh_heartbeat_is_online_and_does_not_change_another_device(): void
    {
        $this->freezeSecond();
        $device = Device::factory()->create(['last_seen_at' => now()->subSeconds(29)]);
        $other = Device::factory()->create();
        (new DeviceCheck)->run($device->id);

        $this->assertSame('online', $device->fresh()->status);
        $this->assertSame('unchecked', $other->fresh()->status);
        $this->assertNull($other->fresh()->last_checked_at);
    }

    public function test_heartbeat_is_offline_at_exactly_thirty_seconds_and_on_repeat(): void
    {
        $this->freezeSecond();
        $heartbeat = now()->subSeconds(30);
        $device = Device::factory()->create(['last_seen_at' => $heartbeat]);
        $check = new DeviceCheck;
        $check->run($device->id);
        $this->assertSame('offline', $device->fresh()->status);

        $this->travel(10)->seconds();
        $check->run($device->id);
        $device->refresh();
        $this->assertSame('offline', $device->status);
        $this->assertTrue($device->last_seen_at->equalTo($heartbeat));
        $this->assertTrue($device->last_checked_at->equalTo(now()));
    }

    public function test_missing_device_is_not_silently_created(): void
    {
        $this->expectException(ModelNotFoundException::class);
        (new DeviceCheck)->run(999);
    }
}
