<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Location;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('car', 'pickupLocation', 'dropLocation')->get();
        return view('admin.booking', compact('bookings'));
    }





    public function store(Request $request)
    {
        $pickup_date = \Carbon\Carbon::createFromFormat('m/d/Y', $request->pickup_date)->format('Y-m-d');
        $return_date = \Carbon\Carbon::createFromFormat('m/d/Y', $request->return_date)->format('Y-m-d');

        // Convert or create pickup and drop locations by name
        $pickupLocation = Location::firstOrCreate(['name' => $request->pickup_location]);
        $dropLocation = Location::firstOrCreate(['name' => $request->drop_location]);

        $booking = new Booking();
        $booking->car_id = $request->car_id;
        $booking->pickup_location = $pickupLocation->id;  // ✅ Store ID, not name
        $booking->pickup_date = $pickup_date;
        $booking->drop_location = $dropLocation->id;      // ✅ Store ID, not name
        $booking->return_date = $return_date;
        $booking->customer_name = $request->name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->dl_number = $request->dl_no;
        $booking->save();

        // Update car status
        // Update car status safely
        $car = Car::find($request->car_id);
        if ($car) {
            $car->status = 1;   // ✅ works now
            $car->save();
        }

        return redirect()->route('home');
    }
}
