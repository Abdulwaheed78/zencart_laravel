<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {

        $Product = Product::with('images')->orderBy('id', 'desc')->get();
        //dd($Product);

        if ($Product) {

            return view('admin.products.index', compact('Product'));
        } else {
            return response('data not found');
        }
    }

    public function search(Request $request)
    {

        //dd($request->search);
        $search = $request->search;
        $Product = Product::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->get();


        //dd($data);
        return view('admin.products.index', compact('Product'));
    }


    public function create()
    {
        $category = Category::all();
        $brand = Brands::all();
        return view('admin.products.create', compact('category', 'subcategory', 'brand'));
    }

    //to store data in databse
    public function store(Request $request)
    {

        try {
            $request->validate([
                'title' => 'required|unique:products',

                'description' => 'nullable',
                'price' => 'required|numeric',
                'compare_price' => 'nullable|numeric',
                'status' => 'required|in:0,1',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'is_featured' => 'required|in:0,1',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
                // Store product data in the products table

            ]);


            $product = new Product();
            $product->title = $request->input('title');
            $product->slug = Str::slug($request->input('title'));
            $product->description = $request->input('description');
            $product->Short_desc = $request->input('short_desc');
            $product->shipping_returns = $request->input('shipping_returns');
            $product->price = $request->input('price');
            $product->compare_price = $request->input('compare_price');
            $product->status = $request->input('status');
            $product->category_id = $request->input('category_id');
            $product->brand_id = $request->input('brand_id');
            $product->is_featured = $request->input('is_featured');
            $product->save();

            // Store product image
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads/products', 'public');

                // Create a new ProductImage record associated with the product
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $imagePath;
                $productImage->save();
            }

            return redirect()->route('product.index')->with('success', 'Product created successfully.')->with('success', 'data updated successfully');
            // Your code for saving the product and image
        } catch (\Exception $e) {
            // Log or print the exception message
            return redirect()->route('product.index')->with('error', 'Product  not created something went wrong.');
        }
    }


    public function edit($id)
    {

        $category = Category::all();
        $brand = Brands::all();
        $data = Product::with('images')->findOrFail($id);
        return view('admin.products.edit', compact('data', 'category', 'subcategory', 'brand'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->title = $request->input('title');
        $product->slug = Str::slug($request->input('title'));
        $product->description = $request->input('description');
        $product->Short_desc = $request->input('short_desc');
        $product->shipping_returns = $request->input('shipping_returns');

        $product->price = $request->input('price');
        $product->compare_price = $request->input('compare_price');
        $product->status = $request->input('status');
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->is_featured = $request->input('is_featured');
        $product->save();
        //dd($request->hasFile('image'));
        // Store product image
        if ($request->hasFile('image')) {
            $productImage = ProductImage::findOrFail($id);
            $imagePath = $request->file('image')->store('uploads/products', 'public');

            // Create a new ProductImage record associated with the product
            $productImage->product_id = $product->id;
            $productImage->image = $imagePath;
            $productImage->save();
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
        // Your code for saving the product and image
    }

    public function destroy($id)
    {
        $delete = Product::findOrFail($id);

        $delete->delete();
        return redirect()->route('product.index')->with('error', 'data deleted successfully');
    }

}
