<?php

namespace Tests\Feature;

use App\Models\Device;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeviceCommandsTest extends TestCase
{
    use RefreshDatabase;

    public function test_heartbeat_and_check_are_separate_steps(): void
    {
        $this->freezeSecond();
        $device = Device::factory()->create();
        $this->artisan('device:heartbeat', ['device' => $device->id])->assertSuccessful();
        $device->refresh();
        $this->assertTrue($device->last_seen_at->equalTo(now()));
        $this->assertSame('unchecked', $device->status);
        $this->assertNull($device->last_checked_at);

        $this->artisan('device:check-now', ['device' => $device->id])
            ->expectsOutput('Saved status: online')->assertSuccessful();
        $this->assertSame('online', $device->fresh()->status);
    }

    public function test_listing_records_does_not_check_them(): void
    {
        $device = Device::factory()->create();
        $this->artisan('device:list')->assertSuccessful();
        $this->assertSame('unchecked', $device->fresh()->status);
        $this->assertNull($device->fresh()->last_checked_at);
    }

    public function test_seeding_twice_preserves_existing_device_state(): void
    {
        $this->seed();
        $device = Device::where('name', 'Pump PLC')->firstOrFail();
        $device->last_seen_at = now();
        $device->save();
        $this->seed();

        $this->assertDatabaseCount('devices', 3);
        $this->assertNotNull($device->fresh()->last_seen_at);
    }
}
