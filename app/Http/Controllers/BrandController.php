<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::get();
        return view('admin.brand.index', compact('brands'));
    }

    public function create() {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $brand = new Brand;
        $brand->name = $request->brand_name;
        $brand->save();

        return redirect()->back()->with('success', 'Brand name added successfully');
    }

    public function edit($id)
    {
        $brand = Brand::findorfail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'brand_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // dd($request->all(), $id);
        $brand = Brand::findorfail($id);
        $brand->name = $request->brand_name;
        $brand->save();

        return redirect()->route('brands')->with('success', 'Brand name updated successfully');
    }

    public function destroy($id){
        $brand = Brand::findorfail($id)->delete();
        return redirect()->back()->with('error', 'Brand name deleted successfully');
    }
}
