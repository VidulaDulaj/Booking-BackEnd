<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillables = [
        'name',
        'surname',
        'Dob',
        'Gender',
        'Email',
        'MobNo',
        'Address'
    ];

    public function Appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function AppointmentSlots()
    {
        return $this->hasMany(AppointmentSlot::class);
    }
}
