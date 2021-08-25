@extends('layouts.master')

@section('title')
    Category
@endsection

@section('master-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="float:left">Category</h3>
                    <a style="float:right" class="btn btn-primary btn-sm" href="{{ route('category.create') }}">Add Caregory</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($categorys as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ ($category->status) == 1 ? 'Active' : 'Inactive' }}</td>
                            <td><img height="100px" src="{{ $category->image }}" alt=""></td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="{{ route('category.edit',$category->id) }}">Edit</a>
                                <a class="btn btn-info btn-xs" href="{{ route('category.show',$category->id) }}">View</a>
                                <a class="btn btn-danger btn-xs" href="{{ route('category.update',$category->id) }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection