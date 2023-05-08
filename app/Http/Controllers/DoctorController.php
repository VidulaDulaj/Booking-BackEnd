<?php

namespace App\Http\Controllers;

use App\Http\Resources\Doctor\DoctorCollection;
use App\Models\Staff;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function getDoctors()
    {
        $staff = Staff::all();

        if($staff) {
            $data = [
                'status' => true,
                'message' => 'Get doctors successfully',
                'data' => new DoctorCollection($staff)
            ];
            return response()->json($data, 200);

        } else {
            $data = [
                'status' => false,
                'message' => 'no doctors found',
                'data' => null
            ];
            return response()->json($data, 404);
        }
    }
}
