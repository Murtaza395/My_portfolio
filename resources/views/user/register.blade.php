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
        <form action="{{route('user.processRegister')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div>
        <label class="form-label text-white">First Name</label>
        <input type="text" value="{{old('fname')}}" name="fname" class="@error('fname') is-invalid @enderror form-control">
        @error('fname')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>
    <div>
        <label class="form-label text-white">Last Name</label>
        <input type="text" value="{{old('lname')}}" name="lname" class="@error('lname') is-invalid @enderror form-control">
        @error('lname')
        <p class="invalid-feedback">{{$message}}</p>
    @enderror
    </div>
    <div>
        <label class="form-label text-white">Email</label>
        <input type="email" value="{{old('email')}}" name="email" class="@error('email') is-invalid @enderror form-control">
        @error('email')
        <p class="invalid-feedback">{{$message}}</p>
    @enderror
    </div>
    <div>
        <label class="form-label text-white">Password</label>
        <input type="password" name="password" class="@error('password') is-invalid @enderror form-control">
        @error('password')
        <p class="invalid-feedback">{{$message}}</p>
    @enderror
    </div>
    <div>
        <label class="form-label text-white">Confirm Password</label>
        <input type="password" name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror form-control">
        @error('password_confirmation')
        <p class="invalid-feedback">{{$message}}</p>
    @enderror
    </div>
    <div>
        <label class="form-label text-white">Profile Pic</label>
        <input type="file" value="{{old('pic')}}" name="pic" class="@error('pic') is-invalid @enderror form-control">
        @error('pic')
        <p class="invalid-feedback">{{$message}}</p>
    @enderror
    </div>
    <div>
        <label class="form-label text-white">Gender</label>
        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
            <option>Select a gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        @error('gender')
        <p class="invalid-feedback">{{$message}}</p>
    @enderror
    </div>
        <div class="justify-content-center d-flex mt-3">
        <button class="btn btn-success form-control">Login</button>
        <a class="" href="{{route('user.login')}}">Already Registered?</a>
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
