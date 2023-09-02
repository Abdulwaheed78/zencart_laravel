@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create sub Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('subcategories.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('subcategories.store') }}" method="POST">
                @csrf
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" required>
                                    <p></p>
                                </div>
                                <!--validation to show that the category is alredy exists in data base take another-->
                                @error('name')
                                    <p class="text-red-500 text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category" name="category_id" id="status">Category</label>

                                    <select name="category_id" class="form-control">
                                        @foreach ($data as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" name="status" id="status">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="showhome" name="showhome" id="status">Show on Home</label>
                                    <select name="showhome" class="form-control" id="showhome">
                                        <option value="Yes">YES</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{route('subcategories.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection



@section('customjs')
@endsection
