<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {

        $data = Category::orderBy('id', 'desc')->get();

        return view('admin.category.index', compact('data'));
    }

    public function search(Request $request)
    {

        //dd($request->search);
        $search = $request->search;
        $data = Category::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();


        //dd($data);
        return view('admin.category.index', compact('data'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:categories',
            ]
        );


        $existingCategory = Category::where('name', $request->name)->first();

        if ($existingCategory) {
            return redirect()->back()->withInput()->withErrors(['name' => 'Category already exists.']);
        } else {


            //Category::create($request->all());
            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->status = $request->status;
            // Check if an image file is present and save it directly in public/images/banner
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->getClientOriginalName();

                // Define the path directly within the public directory
                $destinationPath = public_path('images/category');

                // Ensure the directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true); // Create the directory with proper permissions
                }

                // Move the file to the public/images/banner directory
                $image->move($destinationPath, $imageName);

                // Save the relative path to the database
                $category->image = 'images/category/' . $imageName;
            }
            $category->showhome = $request->showhome;
        }

        if ($category->save()) {
            return redirect()->route('categories.index')->with('success', 'category created successfully');
        } else {
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $data = Category::findOrFail($id);

        return view('admin.category.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);


        if (!$category) {
            return redirect()->route('categories.index');
        }

        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));
        $category->status = $request->input('status');
        $category->showhome = $request->showhome;

        // Check if an image file is present and handle the upload
        if ($request->hasFile('image')) {
            // Delete the old image file if it exists
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image)); // Remove the existing image file
            }

            // Get the new image and define the path directly within the public directory
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('images/category');

            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // Create the directory with proper permissions
            }

            // Move the new file to the public/images/banner directory
            $image->move($destinationPath, $imageName);

            // Save the relative path to the database
            $category->image = 'images/category/' . $imageName;
        }



        $category->save();

        return redirect()->route('categories.index')->with('success', 'data updated successfully');
    }
    public function destroy($id)
    {

        $data = Category::findOrFail($id);

        $data->delete();
        return redirect()->route('categories.index')->with('error', 'data deleteed successfully');
    }
}
