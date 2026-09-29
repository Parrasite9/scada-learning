<?php

namespace App\Models;

use Database\Factories\DeviceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /** @use HasFactory<DeviceFactory> */
    use HasFactory;

    protected $fillable = ['name', 'last_seen_at'];

    protected function casts(): array
    {
        return [
            'last_seen_at' => 'immutable_datetime',
            'last_checked_at' => 'immutable_datetime',
        ];
    }
}
