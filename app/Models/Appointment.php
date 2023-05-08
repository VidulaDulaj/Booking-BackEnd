<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $filables = [
        'staff_id',
        'RefNo',
        'Name',
        'Spec',
        'Cost',
        'Status'
    ];

    public function generateRef()
    {
        $bookings = self::where('created_at', Carbon::now()->format('Y-m-d'))->count();
        return date('Ymd') . ($bookings + 1);
    }

    public function Staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function AppointmentSlots()
    {
        return $this->hasMany(AppointmentSlot::class);
    }
}
