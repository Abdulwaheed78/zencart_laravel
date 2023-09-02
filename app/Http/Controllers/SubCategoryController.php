<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\SubCategories;

use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $data = SubCategories::orderBy('id', 'desc')->get();

        return view('admin.subcategory.index', compact('data'));
    }

    public function search(Request $request)
    {

        //dd($request->search);
        $search = $request->search;
        $data = SubCategories::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();


        //dd($data);
        return view('admin.subcategory.index', compact('data'));
    }


    public function create()
    {
        $data = Category::all();
        return view('admin.subcategory.create', compact('data'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:subcategories',
            ]
        );

        $existingsubCategory = SubCategories::where('name', $request->name)->first();

        if ($existingsubCategory) {
            return redirect()->back()->withInput()->withErrors(['name' => 'Sub-Category already exists.']);
        } else {



            $Subcategory = new SubCategories();
            $Subcategory->name = $request->name;
            $Subcategory->slug = Str::slug($request->name);
            $Subcategory->status = $request->status;
            $Subcategory->showhome = $request->showhome;
            $Subcategory->category_id = $request->category_id;

            if ($Subcategory->save()) {

                return redirect()->route('subcategories.index')->with('success', 'data created successfully');
            } else {
                return redirect()->back();
            }
        }
    }

    public function edit($id)

    {
        $category = Category::all();
        $data = SubCategories::findOrFail($id);
        return view('admin.subcategory.edit', compact('data','category'));
    }



    public function update(Request $request, $id)
    {
        $category = SubCategories::find($id);

        if (!$category) {
            return redirect()->route('subcategories.index');
        }

        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));
        $category->status = $request->input('status');
        $category->showhome = $request->input('showhome');
        $category->category_id=$request->input('category');


        $category->save();

        return redirect()->route('subcategories.index')->with('success', 'data updated successfully');
    }


    public function destroy($id)
    {

        $data = SubCategories::findOrFail($id);
        $data->delete();
        return Redirect()->route('subcategories.index')->with('error', 'data deleted successfully');
    }
}
