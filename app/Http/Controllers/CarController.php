<?php
namespace App\Http\Controllers;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class CarController extends Controller
{
    public function index()
    {
        $cars = Car::orderBy('id')->get();
        return view('cars.index', compact('cars'));
    }
    public function create()
    {
        return view('cars.create');
    }
    public function edit($id)
    {
        $car = Car::find($id); // Fetch the single car$ car by its ID
        return view('cars.edit', compact('car'));
    }
    public function update(Request $request, $id)
    {
    // Validate incoming request data
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|integer|min:0',
        'availability' => 'required|integer|min:0',
        'car_no' => 'nullable',
        'photopath' => 'nullable|image',  // Validate image file
    ]);

    // Find the car by ID, if not found, return an error
    $car = Car::find($id);
    if (!$car) {
        return redirect()->route('cars.index')->with('error', 'Car not found.');
    }

    // Set the default photopath to the existing one
    $data['photopath'] = $car->photopath;

    // Check if a new image has been uploaded
    if ($request->hasFile('photopath')) {
        // Create a unique filename for the new image
        $photoname = time() . '.' . $request->photopath->extension();
        
        // Move the new image to the public images directory
        $request->photopath->move(public_path('uploads/cars'), $photoname);
        
        // Delete the old image file, but only if it exists
        if (file_exists(public_path('uploads/cars/' . $car->photopath))) {
            unlink(public_path('uploads/cars/' . $car->photopath));
        }

        // Update the photopath to the new image
        $data['photopath'] = $photoname;
    }

    // Update the car with the new data
    $car->update($data);

    // Redirect to cars index with a success message
    return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'car_no' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'availability' => 'required|numeric',
            'photopath' => 'required|image',
        ]);
    
        // Handle file upload
        if ($request->hasFile('photopath')) {
            // Get the uploaded file
            $file = $request->file('photopath');
    
            // Define the path where the file should be stored
            $filePath = 'uploads/cars';
            
            // Store the file and get the file name
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($filePath), $fileName);
    
            // Save the car details with the photo path
            $car = new Car();
            $car->car_no = $request->input('car_no');
            $car->name = $request->input('name');
            $car->description = $request->input('description');
            $car->price = $request->input('price');
            $car->availability = $request->input('availability');
            $car->photopath = $filePath . '/' . $fileName; // Save the relative path to the file
            $car->save();
    
            return redirect()->route('cars.index')->with('success', 'Car added successfully!');
        }
    
        return back()->withErrors('File upload failed.');
    }
    public function delete($id)
    {
        $car = Car::find($id);
        File::delete(public_path('images/cars/' . $car->photopath));
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
    
    public function show($id)
    {
        $car = Car::find($id);
    
        if (!$car) {
            return redirect()->route('cars.index')->with('error', 'Car not found');
        }
    
        return \view('cars.view', compact('car'));
    }
    
    
}