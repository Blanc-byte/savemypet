<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class adminController extends Controller
{
    /**
     * Display the user's profile form.
     */
    

    public function viewAppointments()
    {
        
        
        $appointment = collect(DB::select("SELECT u.name, a.id, a.pet_type, a.breed, a.service, a.total_price
                                            FROM appointment a
                                            JOIN users u ON a.customerid = u.id WHERE status = 'pending'"));

        $rooms = collect(DB::select("SELECT * FROM rooms WHERE status = 'available'"));

        
        return view('admin.viewAppointments', ['appointment' => $appointment], ['rooms' => $rooms]);
    }
    public function update(Request $request)
    {
        //dd($request->all());

        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointment,id',
            'room' => 'required|string',
            'datetime' => 'required|date_format:Y-m-d\TH:i', 
        ]);

        
        $datetime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validated['datetime'])->format('Y-m-d H:i:s');

        
        DB::table('appointment')
            ->where('id', $validated['appointment_id'])
            ->update([
                'room' => $validated['room'],
                'date' => $datetime,  
                'status' => 'scheduled',
            ]);

        return redirect()->back()->with('success', 'Appointment updated successfully!');
    }


    public function viewSchedule()
    {
        $appointment = collect(DB::select("SELECT u.name, a.id, a.pet_type, a.breed, a.service, a.total_price
        FROM appointment a
        JOIN users u ON a.customerid = u.id WHERE status = 'scheduled'"));

        
        return view('admin.currently', ['appointment' => $appointment]);
    }
    public function toDone(Request $request){
        $appointmentId = $request->appointment_id;

        $updated = DB::table('appointment')
            ->where('id', $appointmentId)
            ->update(['status' => 'done']);

        if ($updated) {
            return response()->json(['message' => 'Appointment status updated to canceled']);
        } else {
            return response()->json(['message' => 'Appointment not found.'], 404);
        }
    }
    public function toCanceled(Request $request){
        $appointmentId = $request->appointment_id;

        $updated = DB::table('appointment')
            ->where('id', $appointmentId)
            ->update(['status' => 'canceled']);

        if ($updated) {
            return response()->json(['message' => 'Appointment status updated to canceled']);
        } else {
            return response()->json(['message' => 'Appointment not found.'], 404);
        }
    }
    public function viewRooms()
    {
        $rooms = collect(DB::select("SELECT * FROM rooms"));

        return view('admin.rooms',['rooms' => $rooms]);
    }
    public function destroy($doctor)
    {
        $result = DB::table('rooms')->where('id', $doctor)->delete();

        return redirect()->back()->with('success', 'Student deleted successfully');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:available,unavailable',
        ]);

        // Insert a new doctor record using Query Builder
        DB::table('rooms')->insert([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Doctor added successfully']);
    }
    public function updateRoom(Request $request)
    {

        DB::table('rooms')
            ->where('id', $request->doctor_id)
            ->update(['name' => $request->doctor_name,
                        'status' => $request->doctor_status
                    ]);

        return redirect()->back()->with(['message' => 'Appointment not found.'], 404);
    }
    public function viewServices()
    {
        $services = collect(DB::select("SELECT * FROM service"));

        return view('admin.services',['services' => $services]);
    }
    public function destroyservice($doctor)
    {
        $result = DB::table('service')->where('id', $doctor)->delete();

        return redirect()->back()->with('success', 'Student deleted successfully');
    }
    public function storeservice(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:available,unavailable',
        ]);

        // Insert a new doctor record using Query Builder
        DB::table('service')->insert([
            'description' => $request->input('name'),
            'price' => $request->price,
            'status' => $request->input('status'),
            'pet_type' => $request->type,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'Doctor added successfully']);
    }
    public function updateservice(Request $request)
    {

        DB::table('service')
            ->where('id', $request->doctor_id)
            ->update(['description' => $request->doctor_name,
                        'price' => $request->doctor_price,
                        'status' => $request->doctor_status,
                        'pet_type' => $request->doctor_type
                    ]);

        return redirect()->back()->with(['message' => 'Appointment not found.'], 404);
    }
}
