<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .d {
            margin-top: 200px;
        }
    </style>
</head>

<body>
    @include('layouts.header')
    @include('layouts.message')
    @include('layouts.profile')
    <div class="container text-white bg-dark mt-4 ms-3">
        <div class="container d-flex mb-3 mt-3 justify-content-center">
            @if ($profilecount > 0)
                @if (Auth::check())
                    <a href="{{ route('user.uploadproject', Auth::user()->id) }}" class="btn btn-success">
                        Upload a new Project
                    </a>
                @endif
            @endif
        </div>
        @if ($profilecount > 0)
            @foreach ($profiles as $prof)
                <h3 class="text-center bg-danger">Introduction</h3>
                <p class="text-center">{{ $prof->about }}</p>
                <h3 class="text-center bg-danger">Experience</h3>
                <p class="text-center">{{ $prof->experience }}</p>
                <h3 class="text-center bg-danger">About</h3>
                <p class="text-center">{{ $prof->about }}</p>
                <h3 class="text-center bg-danger">Contact</h3>
                <p class="text-center">{{ $prof->contact }}</p>
                <h3 class="text-center bg-danger">Skills</h3>
                <p class="text-center">{{ $prof->skills }}</p>
                <h3 class="text-center bg-danger">Address</h3>
                <p class="text-center">{{ $prof->address }}</p>
            @endforeach
        @else
            <div class="container bg-dark text-white">
                <h1 class="text-center d">Complete Your Profile First</h1>
                @if (Auth::check())
                    <a href="{{ route('user.completeProfile', Auth::user()->id) }}"
                        class="btn btn-primary form-control form-label">Please Click here to complete your profile</a>
                @endif
            </div>
        @endif
    </div>
</div>
    @include('layouts.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
