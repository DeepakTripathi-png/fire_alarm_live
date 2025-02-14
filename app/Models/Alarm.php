<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    use HasFactory;

    protected $fillable = [
       'ioslave_id',
        'message',
        'modbus_data',
        'alarm_status', 
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
    ];

    // Relationship with IOSlave
    public function ioslave()
    {
        return $this->belongsTo(IOSlave::class);
    }
}
