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

                    {{-- @canany multiple valu niye kaj kore --}}

                    @canany(['isAdmin', 'isEditor'])
                    <a style="float:right" class="btn btn-primary btn-sm" href="{{ route('category.create') }}">Add Caregory</a>   
                    @endcanany

                    {{-- @can single valu niye kaj kore --}}

                    {{-- @can('isAdmin')
                    <a style="float:right" class="btn btn-primary btn-sm" href="{{ route('category.create') }}">Add Caregory</a>  
                    @endcan --}}
                    
                </div>
                <div class="card-body">

                    @can('isSupperAdmin')
                        <h1>Is Allow to supper admin</h1>
                    @endcan
                    @can('isAdmin')
                        <h1>Is Allow to admin</h1>
                    @endcan
                    @can('isEditor')
                        <h1>Is Allow to Editor</h1>
                    @endcan
                    
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
                                @can('edit-category', $category)
                                <a class="btn btn-primary btn-xs" href="{{ route('category.edit',$category->slug) }}">Edit</a>
                                @endcan
                                <a class="btn btn-info btn-xs" href="{{ route('category.show',$category->slug) }}">View</a>
                                <form class="d-inline" action="{{ route('category.destroy',$category->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick=" return confirm('Are you Sure Delete This Data?')" class="btn btn-danger btn-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection