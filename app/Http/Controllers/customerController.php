<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class customerController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function home()
    {

        
        $service = collect(DB::select("SELECT * FROM service"));


        return view('customer.home', ['service' => $service]);
    }
    public function store(Request $request)
    {
        
        $request->validate([
            'petType' => 'required|string',
            'breed' => 'required|string',
            'selected_services' => 'required|string',
            'totalPrice' => 'required|numeric',
        ]);

        $customerId = auth()->user()->id;  
        $petType = $request->input('petType');
        $breed = $request->input('breed');
        $services = $request->input('selected_services');
        $totalPrice = $request->input('totalPrice'); 

        // Check if there is already a pending appointment for the customer
        $existingAppointment = DB::table('appointment')
        ->where('customerid', $customerId)
        ->whereIn('status', ['pending', 'Scheduled'])
        ->exists();

        if ($existingAppointment) {
            return redirect()->back()->with('success', 'You already have a pending appointment!');
        }
        DB::table('appointment')->insert([
            'customerid' => $customerId,
            'pet_type' => $petType,
            'breed' => $breed,
            'service' => $services, 
            'total_price' => $totalPrice,
        ]);
        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }

    public function viewAppointment()
    {
        // Get the authenticated user's ID
        $customerId = auth()->user()->id;

        $appointment = collect(DB::select("SELECT * FROM appointment WHERE (status = 'pending' OR status = 'Scheduled') AND customerid = ?",  [$customerId]));


        // $appointment = DB::table('appointment')
        //     ->where('customerid', $customerId)
        //     ->where('status', 'pending')
        //     ->first();

        // Return the view and pass the appointments data
        return view('customer.viewAppointment', ['appointment' => $appointment]);
    }
    public function viewSchedule()
    {
        // Get the authenticated user's ID
        $customerId = auth()->user()->id;

        $appointment = DB::table('appointment')
            ->where('customerid', $customerId)
            ->where('status', 'scheduled')
            ->first();

        // Return the view and pass the appointments data
        return view('customer.scheduled', ['appointment' => $appointment]);
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
}
