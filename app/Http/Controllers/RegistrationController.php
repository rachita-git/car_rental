<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;

class RegistrationController extends Controller
{
    // Show the registration form and list of registered cars
    public function registration()
    {
        $brands = Brand::all();
        $cars = Car::with(['brand', 'model'])->get();
        return view('admin.registration', compact('brands', 'cars'));
    }

    public function create()
    {
        $brands = Brand::all();
        return view('admin.add_car', compact('brands'));
    }


    // Register a new car
    public function car_register(Request $request)
    {
        $request->validate([
            'brand_id'     => 'required|exists:brands,id',
            'model_name'   => 'required|exists:car_models,id',
            'year'         => 'required|numeric',
            'registration' => 'required|string',
            'price'        => 'required|numeric',
            'image'        => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fileName = rand() . '.' . $request->image->extension();
        $request->image->move(public_path('car'), $fileName);

        Car::create([
            'brand_id'      => $request->brand_id,
            'model_id'      => $request->model_name,
            'year'          => $request->year,
            'regd_no'       => $request->registration,
            'price_per_day' => $request->price,
            'image'         => $fileName,
        ]);

        return redirect()->route('registration')->with('success', 'Car registered successfully.');
    }

    // Show all cars on the frontend
    public function showAvailableCars()
    {
        $cars = Car::with(['brand', 'model'])->get();
        return view('car', compact('cars'));
    }



    // Show edit form
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $brands = Brand::all();
        $models = CarModel::where('brand_id', $car->brand_id)->get();

        return view('admin.edit_car', compact('car', 'brands', 'models'));
    }

    // Update car details
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'brand_id'     => 'required|exists:brands,id',
            'model_name'   => 'required|exists:car_models,id',
            'year'         => 'required|numeric',
            'registration' => 'required|string',
            'price'        => 'required|numeric',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $fileName = rand() . '.' . $request->image->extension();
            $request->image->move(public_path('car'), $fileName);
            $car->image = $fileName;
        }

        $car->brand_id = $request->brand_id;
        $car->model_id = $request->model_name;
        $car->year = $request->year;
        $car->regd_no = $request->registration;
        $car->price_per_day = $request->price;
        $car->status = $request->status; 
        $car->save();

        return redirect()->route('registration')->with('success', 'Car updated successfully.');
    }

    // Delete car
    public function delete($id)
    {
        $car = Car::findOrFail($id);

        $imagePath = public_path('car/' . $car->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $car->delete();

        return back()->with('error', 'Car deleted successfully.');
    }



    public function get_model($id)
    {
        $models = CarModel::where('brand_id', $id)->get(['id', 'name']);

        // dd($model);
        return response()->json($models);
    }
}
