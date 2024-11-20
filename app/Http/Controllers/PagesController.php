<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function home()
    {
        $cars = Car::take(6)->get(); // Fetch only 6 cars
        return view('welcome', compact('cars'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function services()
    {
        return view('services');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
    public function car()
    {
        $cars = Car::orderBy('id')->paginate(6); // Fetch paginated results, 6 cars per page
        return view('car', compact('cars'));
    }


    public function search(Request $request)
    {
        // Validate the request inputs
        $validated = $request->validate([
            'brand' => 'nullable|string|max:255',
            'min_price' => 'required|numeric|min:1', // Required, must be numeric and positive
            'max_price' => 'required|numeric|min:1', // Required, must be numeric and positive
            'sort_by' => 'nullable|string|in:price,name', // Allow sorting by price or name
            'order' => 'nullable|string|in:asc,desc' // Ascending or Descending order
        ], [
            // Custom error messages
            'min_price.required' => 'Minimum price is required.',
            'min_price.min' => 'Minimum price must be greater than 0.',
            'max_price.required' => 'Maximum price is required.',
            'max_price.min' => 'Maximum price must be greater than 0.',
        ]);

        // Build the query
        $query = Car::query();

        // Apply filters
        if ($validated['brand']) {
            $query->where('name', 'LIKE', "%" . $validated['brand'] . "%");
        }

        if ($validated['min_price']) {
            $query->where('price', '>=', $validated['min_price']);
        }

        if ($validated['max_price']) {
            $query->where('price', '<=', $validated['max_price']);
        }

        // Apply sorting
        $sortBy = $validated['sort_by'] ?? 'price'; // Default sorting by 'price'
        $order = $validated['order'] ?? 'asc';      // Default order 'asc'
        $query->orderBy($sortBy, $order);

        // Paginate the results
        $cars = $query->paginate(9);
        $properties = $query->get();

        // Return the view with the filtered and sorted cars
        return view('search', compact('cars', 'sortBy', 'order', 'properties'));
    }
}
