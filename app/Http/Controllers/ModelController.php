<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class modelcontroller extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $models = CarModel::all();
        return view('admin.model.index', compact('brands', 'models'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required|exists:brands,id',
            'model_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $model = new CarModel;
        $model->brand_id = $request->brand_id;
        $model->name = $request->model_name;
        $model->save();

        return redirect()->back()->with('success', 'Model added successfully');
    }

    public function edit($id)
    {
        $model = CarModel::findorfail($id);
        $brands = Brand::all();
        return view('admin.model.edit', compact('brands', 'model'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required|exists:brands,id',
            'model_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $model = CarModel::findorfail($id);
        $model->brand_id = $request->brand_id;
        $model->name = $request->model_name;
        $model->save();

        return redirect()->route('models')->with('success', 'Model name updated successfully');
    }

    public function destroy($id){
        $model = CarModel::findorfail($id)->delete();
        return redirect()->back()->with('error', 'Model name deleted successfully');
    }

    public function get_model($id){
        $model = CarModel::where('brand_id',$id)->get();
        // dd($model);
        return response()->json($model);
        
    }
}
