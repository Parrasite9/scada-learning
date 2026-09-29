<?php

namespace App\Tasks;

use App\DeviceCheck;
use LogicException;

class CheckDevice
{
    public int $deviceId;

    public function __construct(int $deviceId)
    {
        $this->deviceId = $deviceId;
    }

    public function handle(): void
    {
        // Lesson 01: use DeviceCheck to check the device identified by this task.
        throw new LogicException('Lesson 01 is unfinished. Open lessons/01-call-the-check.md.');
    }
}
