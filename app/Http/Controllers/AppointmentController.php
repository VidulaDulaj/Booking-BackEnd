<?php

namespace App\Http\Controllers;

use App\Http\Resources\Appointment\AppoinmentResource;
use App\Http\Resources\Doctor\DoctorResource;
use App\Models\Appointment;
use App\Models\AppointmentSlot;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    public function makeAppointment(Request $request)
    {
        $this->validate($request, [
            'doctor_id' => 'required',
            'patient_name' => 'required',
            'reason' => 'required|max:255',
            'booking_month' => 'required',
            'booking_date' => 'required',
            'booking_time' => 'required',
        ]);

        $slot = AppointmentSlot::where('time_slot', $request->booking_time)
            ->where('staff_id', $request->doctor_id)
            ->where('date_slot', $request->booking_date)
            ->first();


        if (empty($slot) || (!$slot->status)) {
            $appointment = new Appointment();
            $appointment->staff_id = $request->doctor_id;
            $appointment->RefNo = $appointment->generateRef();
            $appointment->Name = $request->patient_name;
            $appointment->Spec = $request->reason;
            $appointment->Status = 'booked';

            if ($appointment->save()) {
                $booking_slot = new AppointmentSlot();
                $booking_slot->appointment_id = $appointment->id;
                $booking_slot->staff_id = $appointment->staff_id;
                $booking_slot->time_slot = $request->booking_time;
                $booking_slot->date_slot = $request->booking_date;
                $booking_slot->status = true;
                $booking_slot->save();

                $data = [
                    'status' => true,
                    'message' => 'Appoinment successfuly booked',
                    'data' => new AppoinmentResource($appointment)
                ];
                return response()->json($data, 201);
            } else {
                $data = [
                    'status' => false,
                    'message' => 'Appoinment not booked. Please try agin later.',
                    'data' => null
                ];
                return response()->json($data, 400);
            }
        } else {
            $data = [
                'status' => false,
                'message' => 'Time slot unavailable',
                'data' => null
            ];
            return response()->json($data, 404);
        }
    }

    public function availableBookings($doctorId)
    {
        $doctor = Staff::find($doctorId);

        if ($doctor) {
            $time_slots = ['10:00', '11:00', '12:00', '13:00'];
            $current_date = Carbon::now()->format('Y-m-d');
            $slots = $doctor->AppointmentSlots
                ->where('date_slot', $current_date)
                ->where('status', true)
                ->pluck('time_slot');

            $data = [
                'status' => true,
                'message' => 'Get available bookings successfully',
                'data' => [
                    'doctor' => new DoctorResource($doctor),
                    'available_slots' => array_values(array_diff($time_slots, $slots->toArray())) ?? $time_slots,
                    'date' => $current_date
                ],
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'status' => false,
                'message' => 'No doctor found',
                'data' => null
            ];
            return response()->json($data, 404);
        }
    }
}
