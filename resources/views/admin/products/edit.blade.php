@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
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
            <form action="{{ route('product.edit', $data->id) }}" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" value="{{ $data->title }}" name="title" id="title"
                                                class="form-control" placeholder="Title">
                                        </div>
                                    </div>
                                    @csrf


                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" value="{{ $data->description }}" placeholder="Leave a Short Description here"
                                                name="short_desc" id="floatingTextarea2" style="height: 100px">{{ $data->short_desc }}</textarea>
                                            <label for="floatingTextarea2">Short Description</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" value="{{ $data->description }}" placeholder="Leave a Full Description here"
                                                name="description" id="floatingTextarea2" style="height: 100px">{{ $data->short_desc }}</textarea>
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
                                    <input type="file" value="" class="form-control-file" id="image"
                                        name="image">
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
                                            <input type="text" value="{{ $data->price }}" name="price" id="price"
                                                class="form-control" placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="compare_price">Compare at Price</label>
                                            <input type="text" value="{{ $data->compare_price }}" name="compare_price"
                                                id="compare_price" class="form-control" placeholder="Compare Price">
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
                                            <textarea class="form-control" placeholder="Leave a Shipping and Returns" value="" name="shipping_returns"
                                                id="floatingTextarea2" style="height: 100px">{{ $data->shipping_returns }}</textarea>
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
                                    <select name="status" value="{{ $data->status }}" id="status" class="form-control">
                                        @if ($data->status == 1)
                                            <option value="1">Active</option>
                                        @else
                                            <option value="0">Block</option>
                                        @endif
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product category</h2>
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <select name="category_id" id="categorySelect" class="form-control">
                                        <option value="" selected>Select Category</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ $data->category_id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="category">Sub category</label>
                                    <select name="subcategory_id" id="subcategorySelect" class="form-control">
                                        <option value="" selected>Select Subcategory</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product brand</h2>
                                <div class="mb-3">
                                    <select name="brand_id" id="brandSelect" class="form-control">
                                        <option value="">Select Brand</option>
                                        @foreach ($brand as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $data->brand_id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
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
                                        <option value="1" {{ $data->is_featured == 1 ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0" {{ $data->is_featured == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="pb-5 pt-3">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <a href="{{ route('product.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>

        </div>
        <!-- /.card -->
    </section>
@endsection



@section('customjs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var categorySelect = document.getElementById('categorySelect');
            var subcategorySelect = document.getElementById('subcategorySelect');

            categorySelect.addEventListener('change', function() {
                var selectedCategoryId = this.value;

                // Clear previous subcategory and brand options
                subcategorySelect.innerHTML =
                    '<option value="{{ $data->subcategory ? $data->sub_category_id : 'null' }}">{{ $data->subcategory ? $data->subcategory->name : 'null' }}</option>';


                // Retrieve subcategories based on selected category
                @foreach ($subcategory as $sub)
                    if ({{ $sub->category_id }} == selectedCategoryId) {
                        subcategorySelect.innerHTML +=
                            '<option value="{{ $sub->id }}">{{ $sub->name }}</option>';
                    }
                @endforeach
            });



            // Trigger the change event to populate subcategories initially if needed
            categorySelect.dispatchEvent(new Event('change'));
        });
    </script>
@endsection
