<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .d {
            margin-top: 150px;
        }
    </style>
</head>

<body>
    @include('layouts.header')
    @include('layouts.message')
    <div class="d-flex ms-3">
        @if (Auth::check())
        @foreach ($user as $user)
        <div class="card border border-dark" style="width: 18rem; margin-top:20px;">
            <img src="{{ asset('uploads/profile/thumb/'.$user->profile_pic )}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$user->name}}</h5>
                <p class="card-text">{{$user->email}}</p>
            </div>
        </div>       
        @endforeach
        @endif
    <div class="container text-white bg-dark mt-4 ms-3">
        @if ($profileCount>0)
        @foreach ($pro as $profiles)
                <h3 class="text-center bg-danger">Introduction</h3>
                <p class="text-center">{{$profiles->about}}</p>
                <h3 class="text-center bg-danger">Experience</h3>
                <p class="text-center">{{$profiles->experience}}</p>
                <h3 class="text-center bg-danger">Contact</h3>
                <p class="text-center">{{$profiles->contact}}</p>
                <h3 class="text-center bg-danger">Country</h3>
                <p class="text-center">{{$profiles->country}}</p>
                <h3 class="text-center bg-danger">Skills</h3>
                <p class="text-center">{{$profiles->skills}}</p>
                <h3 class="text-center bg-danger">Address</h3>
                <p class="text-center">{{$profiles->address}}</p>
                            
        @endforeach
        @else
                <h1 class="text-center d">Oops! User has not completed his/her profile yet</h1>
        @endif

    </div>
    </div>
    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
