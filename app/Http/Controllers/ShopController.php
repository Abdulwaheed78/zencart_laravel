<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brands;
use App\Models\Product;
use App\Models\SubCategories;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subCategorySlug = null)
    {
        $categorySelected = '';

        $subCategorySelected = '';
        $brandArray = [];




        $categories = Category::orderBy('name', 'ASC')->with('sub_category')->where('status', 1)->get();
        $brands = Brands::orderBy('name', 'ASC')->where('status', 1)->get();
        $products = Product::where('status', 1);

        // Apply Filters here
        if (!empty($categorySlug)) {
            $category = Category::where('slug', $categorySlug)->first();
            $products = $products->where('category_id', $category->id);
            $categorySelected = $category->id;
        }

        if (!empty($subCategorySlug)) {
            $subCategory = SubCategories::where('slug', $subCategorySlug)->first();
            $products = $products->where('sub_category_id', $subCategory->id);
            $subCategorySelected = $subCategory->id;
        }


        if (!empty($request->get('brand'))) {
            $brandArray = explode(',', $request->get('brand'));
            $products = $products->whereIn('brand_id', $brandArray);
        }

        if ($request->get('price_max') != '' && $request->get('price_min') != '') {
            if ($request->get('price_max') == 1000) {
                $products = $products->whereBetween('price', [intval($request->get('price_min')), 1000000]);
            } else {
                $products = $products->whereBetween('price', [intval($request->get('price_min')), intval($request->get('price_max'))]);
            }
        }


        if ($request->get('sort') != '') {
            if ($request->get('sort') == 'letest') {

                $products = $products->orderBy('id', 'DESC');
            } elseif ($request->get('sort') == 'price_asc') {
                $products = $products->orderBy('price', 'ASC');
            } else {
                $products = $products->orderBy('price', 'DESC');
            }
        } else {
            $products = $products->orderBy('id', 'DESC');
        }



        // Search query
        $search = $request->search;
        if ($search) {
            $products = $products->where('title', 'LIKE', "%{$search}%");
        }


        // Get the sorted products
        $products = $products->get();

        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['products'] = $products;
        $data['search'] = $search;
        $data['categorySelected'] = $categorySelected;
        $data['subCategorySelected'] = $subCategorySelected;
        $data['brandArray'] = $brandArray;

        $data['priceMax'] = (intval($request->get('price_max')) == 0) ? 1000 : $request->get('price_max');
        $data['priceMin'] = intval($request->get('price_min'));
        $data['sort'] = $request->get('sort');
        return view('front.shop', $data);
    }


    public function search(Request $request)
    {
        //dd($data);
        return view('front.shop', compact('data'));
    }


    /*

    public function index2($categorySlug = null, $subcategorySlug = null, $brandSlug = null)
    {
        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();
            $subcategory = null;
            $brands = null;
            $products = null;

            if ($subcategorySlug) {
                $subcategory = SubCategories::where('category_id', $category->id)
                    ->first();

                if (!$subcategory) {
                    return redirect()->route('error.page')->with('error', 'Subcategory not found.');
                }

                if ($brandSlug) {
                    $brand = Brands::where('slug', $brandSlug)
                        ->where('category_id', $category->id)
                        ->where('sub_category_id', $subcategory->id)
                        ->get();

                    if (!$brand) {
                        return redirect()->route('error.page')->with('error', 'Brand not found.');
                    }

                    $products = Product::with('images')
                        ->where('category_id', $category->id)
                        ->where('sub_category_id', $subcategory->id)
                        ->where('brand_id', $brand->id)
                        ->get();
                } else {
                    $products = Product::with('images')
                        ->where('category_id', $category->id)
                        ->where('sub_category_id', $subcategory->id)
                        ->get();
                    $brands = Brands::where('category_id', $category->id)
                        ->where('subcategory_id', $subcategory->id)
                        ->get();
                }
            } else {
                $subcategory = SubCategories::where('category_id', $category->id)->get();
                $products = Product::with('images')->where('category_id', $category->id)->get();
                $brands = Brands::where('category_id', $category->id)->get();
            }

            if ($products->isEmpty()) {
                return view('front.testshop', compact('category'))->with('error', 'No products found.');
            }

            return view('front.testshop', compact('category', 'subcategory', 'brands', 'products'));
        }

        // Handle the case when no category slug is provided
        // ...
    } */
}
