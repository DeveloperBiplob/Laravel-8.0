@extends('layouts.master')
@section('title', 'Update Category')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <h3 style="float: left;">Update Category</h3>
            <a style="float: right;" href="{{ route('category.index') }}" class="btn btn-primary ">Back Category</a>
        </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-gorup">
                            <label for="">Name:</label>
                            <input class="form-control" type="text" value="{{ $category->name }}" name="name" id="" placeholder="Enter a Name">
                        </div>
                        <div class="form-gorup">
                            <label for="">Status:</label>
                            <select class="form-control" name="status" id="">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-gorup">
                            <label for="">Image: </label><br>
                            <img height="100px" src="{{ asset($category->image) }}" alt="">
                            <input class="form-control" type="file" name="image" id="" >
                        </div>
                        <div class="form-gorup">
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">Add Category</button>
                        </div>
                    </form>
                </div>
    </div>


@endsection
