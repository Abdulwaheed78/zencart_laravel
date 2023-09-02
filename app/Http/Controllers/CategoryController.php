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

    public function search(Request $request){

        //dd($request->search);
        $search=$request->search;
        $data=Category::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();


            //dd($data);
        return view('admin.category.index',compact('data'));
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
        }else{


        //Category::create($request->all());
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $imagePath = $request->file('image')->store('category_images', 'public');
        $category->showhome = $request->showhome;
        $category->image = $imagePath;
        //$request->save();

        }

        if ($category->save()) {

            return redirect()->route('categories.index')->with('success','category created successfully');
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
        if ($request->hasFile('image')){
            if ($category->image) {
                // Assuming 'public' is the disk name
                Storage::delete('storage/'.$category->image);
            }
            $imagePath = $request->file('image')->store('product_images', 'public');
            $category->image = $imagePath;
        }


        $category->save();

        return redirect()->route('categories.index')->with('success','data updated successfully');    }
    public function destroy($id)
    {

        $data=Category::findOrFail($id);

        $data->delete();
        return redirect()->route('categories.index')->with('error','data deleteed successfully');
    }
}
