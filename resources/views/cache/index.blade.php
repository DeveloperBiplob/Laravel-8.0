@extends('layouts.master')

@section('title')
    Cache
@endsection

@section('master-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="float:left">Cache</h3>
                    <a style="float:right" class="btn btn-primary btn-sm" href="">Add Caregory</a>   
                </div>
                <div class="card-body">  
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($caches as $cache)
                        <tr>
                            <td>{{ $cache->name }}</td>
                            <td>{{ ($cache->status) == 1 ? 'Active' : 'Inactive' }}</td>
                            <td><img height="100px" src="{{ $cache->image }}" alt=""></td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="">Edit</a>
                                <a class="btn btn-info btn-xs" href="">View</a>
                                <form class="d-inline" action="" method="POST">
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