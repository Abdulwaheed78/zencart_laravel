<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\banner;

class bannerController extends Controller
{

    public function index()
    {
        $data = Banner::orderBy('id', 'desc')->get();
        return view('admin.banner.index', compact('data'));
    }

    public function search(Request $request)
    {
        $search = $request->search;

        // Execute the query and get the results
        $data = Banner::orderBy('id', 'desc')
            ->where('title', 'LIKE', "%{$search}%")
            ->get(); // Call get() to retrieve the results

        return view('admin.banner.index', compact('data'));
    }


    public function create()
    {
        return view('admin.banner.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'link' => 'nullable',
                'showhome' => 'required',
                'desc' => 'nullable',
                'image' => 'nullable|image' // Adding validation for the image file
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $banner = new Banner();
        $banner->title = $request->name;
        $banner->description = $request->desc;
        $banner->route = $request->link;
        $banner->status = $request->showhome;

        // Check if an image file is present and save it directly in public/images/banner
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();

            // Define the path directly within the public directory
            $destinationPath = public_path('images/banner');

            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // Create the directory with proper permissions
            }

            // Move the file to the public/images/banner directory
            $image->move($destinationPath, $imageName);

            // Save the relative path to the database
            $banner->image = 'images/banner/' . $imageName;
        }

        if ($banner->save()) {
            return redirect()->route('banner.index')->with('success', 'Banner added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add banner');
        }
    }

    public function edit($id)
    {
        $data = banner::findOrFail($id);
        return view('admin.banner.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        // Find the banner by ID or fail
        $banner = Banner::findOrFail($id);

        // Validate the incoming request data
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'link' => 'nullable',
                'showhome' => 'required',
                'desc' => 'nullable',
                'image' => 'nullable|image' // Adding validation for the image file
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update banner properties
        $banner->title = $request->name;
        $banner->description = $request->desc;
        $banner->route = $request->link;
        $banner->status = $request->showhome;

        // Check if an image file is present and handle the upload
        if ($request->hasFile('image')) {
            // Delete the old image file if it exists
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image)); // Remove the existing image file
            }

            // Get the new image and define the path directly within the public directory
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('images/banner');

            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // Create the directory with proper permissions
            }

            // Move the new file to the public/images/banner directory
            $image->move($destinationPath, $imageName);

            // Save the relative path to the database
            $banner->image = 'images/banner/' . $imageName;
        }

        // Save the banner updates
        $banner->save();

        return redirect()->route('banner.index')->with('success', 'Data updated successfully');
    }


    public function destroy($id)
    {
        $data = banner::findOrFail($id);
        $data->delete();
        return redirect()->route('banner.index')->with('error', 'Banner deleted successfully');
    }
}
