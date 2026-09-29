<?php

namespace Tests\Lessons;

use App\Models\Device;
use App\Tasks\CheckDevice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckDeviceTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_checks_its_stored_device_using_the_current_record(): void
    {
        $this->freezeSecond();
        $untouched = Device::factory()->create();
        $device = Device::factory()->create();
        $task = new CheckDevice($device->id);

        $device->last_seen_at = now();
        $device->save();
        $task->handle();

        $this->assertSame('online', $device->fresh()->status);
        $this->assertNotNull($device->fresh()->last_checked_at);
        $this->assertSame('unchecked', $untouched->fresh()->status);

        $this->travel(30)->seconds();
        $task->handle();
        $this->assertSame('offline', $device->fresh()->status);

        $device->last_seen_at = null;
        $device->save();
        $task->handle();
        $this->assertSame('unknown', $device->fresh()->status);
    }
}
