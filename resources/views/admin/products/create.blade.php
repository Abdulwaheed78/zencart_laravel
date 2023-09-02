@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                placeholder="Title">
                                        </div>
                                    </div>
                                    @csrf

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a Short Description here" name="short_desc" id="floatingTextarea2"
                                                style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">Short Description</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a  Description here" name="description" id="floatingTextarea2"
                                                style="height: 100px"></textarea>
                                            <label for="floatingTextarea2"> Full Description</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Media</h2>
                                <div class="form-group">
                                    <label for="image">Choose an Image:</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Pricing</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" id="price" class="form-control"
                                                placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="compare_price">Compare at Price</label>
                                            <input type="text" name="compare_price" id="compare_price"
                                                class="form-control" placeholder="Compare Price">
                                            <p class="text-muted mt-3">
                                                To show a reduced price, move the product’s original price into Compare at
                                                price. Enter a lower value into Price.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a Shipping and Returns" name="shipping_returns" id="floatingTextarea2"
                                                style="height: 100px"></textarea>
                                            <label for="floatingTextarea2"> Shipping and Returns Policy</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product status</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4  mb-3">Product category</h2>
                                <div class="mb-3">
                                    <label for="category">Category</label>

                                    <select name="category_id" id="categorySelect" class="form-control">
                                        <option value="" selected="">Add a Category here</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="category">Sub category</label>

                                    <select name="sub_category_id" id="subcategorySelect" class="form-control">
                                        <option value="" selected="">Add a SubCategory here</option>

                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product brand</h2>
                                <div class="mb-3">
                                    <select name="brand_id" id="status" class="form-control">
                                        @foreach ($brand as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Featured product</h2>
                                <div class="mb-3">
                                    <select name="is_featured" id="status" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="pb-5 pt-3">
                    <button class="btn btn-primary" type="submit">Create</button>
                    <a href="{{ route('brand.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>

        </div>
        <!-- /.card -->
    </section>
@endsection



@section('customjs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('categorySelect').addEventListener('change', function() {
                var selectedCategoryId = this.value;
                var subcategorySelect = document.getElementById('subcategorySelect');

                // Clear previous subcategory options
                subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

                // Retrieve subcategories based on selected category
                @foreach ($subcategory as $sub)
                    if ({{ $sub->category->id }} == selectedCategoryId) {
                        subcategorySelect.innerHTML +=
                            '<option value="{{ $sub->id }}">{{ $sub->name }}</option>';
                    }
                @endforeach
            }); // Your code here
        });
    </script>
@endsection
