@extends('layouts.master')
@section('title', 'Add Category')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left;">Add New Category</h3>
            <a style="float: right;" href="{{ route('category.index') }}" class="btn btn-primary ">Back Dashboard</a>
        </div>
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-gorup">
                            <label for="">Name</label>
                            <input class="form-control" type="text" name="name" id="" placeholder="Enter a Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-gorup">
                            <label for="">Status</label>
                            <select class="form-control" name="status" id="">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-gorup">
                            <label for="">Image</label>
                            <input class="form-control" type="file" name="image" id="" >
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-gorup">
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">Add Category</button>
                        </div>
                    </form>
                </div>
    </div>


@endsection
