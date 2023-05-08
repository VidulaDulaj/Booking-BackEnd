<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentSlot extends Model
{
    use HasFactory;

    protected $filables = [
        'staff_id',
        'time_slot',
        'status'
    ];

    public function Staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
