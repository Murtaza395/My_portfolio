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
    @include('layouts.profile')
    <div class="container text-white bg-dark mt-4 ms-3">
        <form action="{{route('user.processChangePass',Auth::user()->id)}}" method="post">
            @csrf
            @method('put')
            <label class="form-label">Current Password</label>
            <input type="password" class="@error('current_password') is-invalid @enderror form-control" name="current_password">
            @error('current_password')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
            <label class="form-label">New Password</label>
            <input type="password" class="@error('password') is-invalid @enderror form-control" name="password">
            @error('password')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
            <label class="form-label">Confirm Password</label>
            <input type="password" class="@error('password_confirmation') is-invalid @enderror form-control"
                name="password_confirmation">
            @error('password_confirmation')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
            <button class="btn btn-primary mt-2 form-control">Update Password</button>
        </form>
    </div>
    </div>
    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
