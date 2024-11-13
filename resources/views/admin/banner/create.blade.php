@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Banner</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('banner.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Title</label>
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
                                    <label for="name">Link</label>
                                    <input type="text" name="link" id="link" class="form-control"
                                        placeholder="Link" >
                                    <p></p>
                                </div>
                                <!--validation to show that the category is alredy exists in data base take another-->
                                @error('link')
                                    <p class="text-red-500 text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Choose Image</label>
                                    <input type="file" name="image" id="image" class="form-control"
                                        placeholder="Image  " required>
                                    <p></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="showhome" name="showhome" id="status">Show on Home</label>
                                    <select name="showhome" class="form-control" id="showhome">
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-12">
                                <label for="status" name="desc" id="desc">Description</label>
                                <textarea name="desc" id="desc" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('banner.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection



@section('customjs')
@endsection
