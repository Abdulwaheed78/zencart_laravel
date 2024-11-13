@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('categories.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('categories.edit',$data->id) }}" method="POST" enctype="multipart/form-data" >
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
                                    <label for="status"  name="status" id="status">Status</label>
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
                                    <label for="name">Image</label>
                                    <input type="file" name="image" value="" id="image" class="form-control mb-1"
                                        placeholder="Name" >
                                        <img src="{{asset($data->image)}}" height="75px"  width="75px"alt="not found">

                                    <p></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="showhome" name="showhome" id="showhome">Show on Home</label>
                                    <select name="showhome" class="form-control" id="showhome">
                                        <option {{($data->showhome=='YES')?'selected':''}} value="YES">YES</option>
                                        <option {{($data->showhome=='NO')?'selected':''}} value="NO">NO</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('categories.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection



@section('customjs')


@endsection
