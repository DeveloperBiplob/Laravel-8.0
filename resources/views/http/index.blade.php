@extent('layouts.master')
@section('title', 'HTTP')
@section('master-content')
    @php
        // var_dump($data)
        // var_dump($data->data)
    @endphp

    @foreach($data->data as $row)
        <h1>{{ $row->title }}</h1>
        <hr>
    @endforeach
@endsection