@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Sub Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('subcategories.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('subcategories.edit',$data->id) }}" method="POST" >
                @csrf
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{$data->name}}" id="name" class="form-control"
                                        placeholder="Name" required>
                                    <p></p>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" value="" name="status" id="status">Status</label>

                                    <select name="status" class="form-control" id="status">
                                        <option {{($data->status==1)?'selected':''}} value="1">Active</option>
                                        <option {{($data->status==0)?'selected':''}} value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" value="showhome" name="showhome" id="showhome">Show On Home</label>

                                    <select name="showhome" class="form-control" id="status">
                                        <option {{($data->showhome=='Yes')?'selected':''}} value="Yes">YES</option>
                                        <option {{($data->showhome=='NO')?'selected':''}} value="NO">NO</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category" value="showhome" name="category" id="showhome">Category</label>

                                    <select name="category" class="form-control" id="category">
                                        <option value="{{$data->category_id}}"  selected="">{{$data->category->name}}</option>
                                        @foreach ($category as $cat )
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
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
