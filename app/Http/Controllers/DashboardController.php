<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total number of users
        $totalUsers = User::count();

        // Get total number of cars
        $totalCars = Car::count();

        // Get available cars
        $availableCars = Car::where('availability', '>', 0)->count();

        // Calculate booked cars (using the bookings table, assuming status 'booked' tracks bookings)
        $bookedCars = Book::where('status', 'booked')->count();

        // Assuming total visits are fetched from logs or another table (adjust as needed)
        $totalVisits = 30; // Replace 'visits' with the actual column in your DB

        // Monthly user growth (grouping by month of registration)
        $monthlyUserGrowth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')->toArray();

        // Ensure all months are represented (1 to 12)
        $monthlyUserGrowth = array_replace(array_fill(1, 12, 0), $monthlyUserGrowth);

        // Total visited users per day (replace 'visits' with actual logic/column for tracking visits)
        $visitedUsersPerDay = Car::selectRaw('DATE(created_at) as date, COUNT(*) as total_visits')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->pluck('total_visits', 'date')->toArray();

        return view('dashboard', compact(
            'totalUsers', 
            'totalCars', 
            'availableCars', 
            'bookedCars', 
            'totalVisits', 
            'monthlyUserGrowth', 
            'visitedUsersPerDay'
        ));
    }

    public function notification()
    {
        // Fetch notifications related to booked cars
        $notifications = Book::with('car', 'user')
            ->where('status', 'booked')
            ->get();

        return view('notification', compact('notifications'));
    }

    public function view($id)
    {
        // View a specific booking's details
        $notification = Book::with('car', 'user')->findOrFail($id);

        return view('view', compact('notification'));
    }

    public function viewDetails($id)
    {
        $booking = Book::with('car', 'user')->findOrFail($id);
    
        // Convert string dates to Carbon instances
        $booking->created_at = Carbon::parse($booking->created_at);
        $booking->start_date = \Carbon\Carbon::parse($booking->start_date);
        $booking->end_date = \Carbon\Carbon::parse($booking->end_date);
    
        return view('viewbookingdetails', compact('booking'));
    }
}


