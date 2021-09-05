<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Hello Form test Mail</h1>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h3>Biplob</h3>
                <p>0196784545</p>
                <p>biplob@mail.com</p>
            </div>
            <div class="col-md-6">
                <h3>Hello World!</h3>
                <p>30-06-2021</p>
            </div>
        </div>

        @foreach($data as $d)
            <p>{{ $d }}</p>
            <hr>
        @endforeach

        <h1>First Index :{{ $firstIndex }}</h1>
        <div>
            <h3>User Information</h3>
            <hr>
            <img height="300px" src="{{ asset('storage/image/1630258191_612bc40f6db24.jpg') }}" alt="">
            <p>User Name : {{ $user->name }}</p>
            <p>User Eamil : {{ $user->email }}</p>
            <p>User Created at : {{ $user-> created_at -> format('Y-m-d h:i:s') }}</p>
            <p>User Created at : {{ $user-> created_at -> diffForHumans() }}</p> <!-- diffForHumans() Time ta ke ai (1 week ago) formet e convert kore -->
        </div>
    </div>
</body>
</html>