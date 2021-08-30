@extends('layouts.master')

@section('title')
    Skill
@endsection

@section('master-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 style="float:left">Skill</h3>
                    <a style="float:right" class="btn btn-primary btn-sm" href="{{ route('skill.create') }}">Add Caregory</a>                     
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
                            <th>User</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($skills as $skill)
                        <tr>
                            <td>{{ $skill->name }}</td>
                            <td>{{ $skill->user->name }}</td>
                            <td>

                                @can('update', $skill)
                                <a class="btn btn-primary btn-xs" href="{{ route('skill.edit',$skill->id) }}">Edit</a>   
                                @endcan

                                {{-- @can('view', $skill) --}}
                                <a class="btn btn-info btn-xs" href="{{ route('skill.show',$skill->id) }}">View</a>
                                {{-- @endcan --}}

                                @can('delete', $skill)
                                <form class="d-inline" action="{{ route('skill.destroy',$skill->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick=" return confirm('Are you Sure Delete This Data?')" class="btn btn-danger btn-xs">Delete</button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection