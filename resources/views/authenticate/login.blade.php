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
    </style>
</head>

<body>
    @include('layouts.header')
    @include('layouts.message')
    @include('layouts.profile')
    <div class="container bg-dark mt-4 ms-3">
        <form action="{{route('authenticate.processLogin')}}" method="post">
            @csrf
        <div>
        <label class="form-label text-white">Email</label>
        <input type="email" name="email" class="@error('email')is-invalid @enderror form-control">
        @error('email')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>
    <div>
        <label class="@error('password')is-invalid @enderror form-label text-white">Password</label>
        <input type="password" name="password" class="form-control">
        @error('password')
        <p class="invalid-feedback">{{$message}}</p>
    @enderror
    </div>
        <div class="justify-content-center d-flex  mt-3">
        <button class="btn btn-success form-control">Login</button>
        <a class="ms-2" href="{{route('user.register')}}">Create a new account?</a>
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </div>
</form>
    </div>
    </div>
    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
