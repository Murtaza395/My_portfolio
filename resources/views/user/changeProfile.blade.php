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
            margin-top: 200px;
        }
    </style>
</head>

<body>
    @include('layouts.header')
    @include('layouts.message')
    <div class="d-flex ms-3 justify-content-center">
        @if (Auth::check())
            <div class="card border border-dark" style="width: 25rem; margin-top:20px;">
                <img src="{{ asset('uploads/profile/thumb/' . Auth::user()->profile_pic) }}" class="card-img-top"
                    alt="...">
                <div class="card-body text-white bg-dark">
                    <h5 class="card-title">{{ Auth::user()->name }}</h5>
                    <p class="card-text">{{ Auth::user()->email }}</p>
                    <form action="{{ route('user.processChangeDP',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <label class="form-label">Upload Image</label>
                        <input type="file" name="image" class="form-control btn btn-primary">
                        <button class="btn btn-success mt-2 form-control">Update Profile</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
