@extends('layouts.master')
@section('title', 'Show Category')
@section('master-content')
    <div class="card">
        <div class="card-header">
            <h1 class="text-info float-left">Show Category</h1>
            <a class="btn btn-primary float-right" href="{{ route('category.index') }}">Back Category</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td><img height="100px" src="{{ asset($category->image) }}" alt=""></td>
                </tr>
            </table>
        </div>
    </div>
@endsection