<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Category;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BrandController extends Controller
{


    public function index()
    {
        $data = Brands::all();
        // dd($data);

        return view('admin.brand.index', compact('data'));
    }

    public function search(Request $request)
    {

        //dd($request->search);
        $search = $request->search;
        $data = Brands::query()
            ->where('name', 'LIKE', "%{$search}%");


        //dd($data);
        return view('admin.brand.index', compact('data'));
    }

    public function create()
    {

        return view('admin.brand.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:brands',
                'category_id' => 'nullable|exists:categories,id',
                'subcategory_id' => 'nullable|exists:sub_categories,id',
            ]
        );

        if ($validator->fails()) {
            //dd($validator);
            return redirect()->back()->with('error', 'not found');
        }

        $existingBrand = Brands::where('name', $request->name)->first();

        if ($existingBrand) {
            return redirect()->back()->withInput()->withErrors(['name' => 'Brand already exists.']);
        } else {
            $brand = new Brands();
            $brand->name = $request->name;
            $brand->slug = Str::slug($request->name);
            $brand->status = $request->status;

            if ($brand->save()) {
                return redirect()->route('brand.index')->with('success', 'Data created successfully');
            } else {
                return redirect()->back();
            }
        }
    }

    public function edit($id)
    {
        $data = Brands::findOrFail($id);


        return view('admin.brand.edit', compact('data'));
    }



    public function update(Request $request, $id)
    {
        $brand = Brands::findOrFail($id);

        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'id not found');
        }

        $brand->name = $request->input('name');
        $brand->slug = Str::slug($request->input('name'));
        $brand->status = $request->input('status');

        $brand->save();

        return redirect()->route('brand.index')->with('success', 'data updated successfully');
    }
    public function destroy($id)
    {

        $data = Brands::findOrFail($id);
        $data->delete();
        return redirect()->route('brand.index')->with('error', 'data deleted successfully');
    }
}
