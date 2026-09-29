<?php

use App\DeviceCheck;
use App\Models\Device;
use App\Tasks\CheckDevice;
use Illuminate\Support\Facades\Artisan;

Artisan::command('device:list', function () {
    $devices = Device::orderBy('id')->get();

    $this->table(
        ['ID', 'Device', 'Saved status', 'Last heartbeat', 'Last check'],
        $devices->map(fn (Device $device) => [
            $device->id,
            $device->name,
            $device->status,
            $device->last_seen_at?->toDateTimeString() ?? 'none',
            $device->last_checked_at?->toDateTimeString() ?? 'never',
        ])->all(),
    );
})->purpose('Read the saved device records without checking them');

Artisan::command('device:heartbeat {device : Device ID}', function () {
    $device = Device::findOrFail($this->argument('device'));
    $device->last_seen_at = now();
    $device->save();

    $this->info('Heartbeat saved for '.$device->name.'. Its status has not been checked yet.');
})->purpose('Simulate a heartbeat for one device');

Artisan::command('device:check-now {device : Device ID}', function () {
    $device = Device::findOrFail($this->argument('device'));
    $check = new DeviceCheck;
    $check->run($device->id);

    $this->info('Saved status: '.$device->fresh()->status);
})->purpose('Run the supplied check directly, bypassing the learner task');

Artisan::command('device:run-task {device : Device ID}', function () {
    $device = Device::findOrFail($this->argument('device'));
    $task = new CheckDevice($device->id);

    try {
        $task->handle();
    } catch (LogicException $exception) {
        $this->error($exception->getMessage());

        return 1;
    }

    $this->info('Saved status: '.$device->fresh()->status);

    return 0;
})->purpose('Run your task immediately; no queue or worker is involved yet');
