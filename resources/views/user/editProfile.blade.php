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
    <div class="container bg-dark text-white mt-4 ms-3">
        @if (Auth::check())
            <form action="{{route('user.processEditProfile',Auth::user()->id)}}" method="post">
                @method('put')
                @csrf
                <h1 class="text-white">Provide more details about yourself</h1>
                <div>
                    <label class="form-label text-white">Full Name</label>
                    <input type="text" name="name" class="@error('name') is-invalid @enderror form-control"
                        value="{{ old('name', Auth::user()->name) }}">
                    @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="form-label text-white">Country</label>
                    <input type="text" name="country" class="@error('country') is-invalid @enderror form-control"
                        value="{{ old('country',$profile->country) }}">
                    @error('country')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="form-label text-white">Address</label>
                    <textarea name="address" cols="30" rows="3" class="@error('address') is-invalid @enderror form-control">{{ old('address',$profile->address) }}</textarea>
                    @error('address')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="form-label text-white">About</label>
                    <textarea name="about" cols="30" rows="3" class="@error('about') is-invalid @enderror form-control">{{ old('about',$profile->about) }} </textarea>
                    @error('about')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="form-label text-white">Add Your Skills</label>
                    <textarea name="skills" cols="30" rows="3" class="@error('skills') is-invalid @enderror form-control">{{ old('skills',$profile->skills) }} </textarea>
                    @error('skills')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="form-label text-white">Contact</label>
                    <textarea name="contact" cols="30" rows="3" class="@error('contact') is-invalid @enderror form-control">{{ old('contact',$profile->contact) }} </textarea>
                    @error('contact')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="form-label text-white">Experience</label>
                    <textarea name="experience" cols="30" rows="3"
                        class="@error('experience') is-invalid @enderror form-control"> {{ old('experience',$profile->experience) }}</textarea>
                    @error('experience')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-danger mt-3 form-control">Update Profile</button>
                </div>
            </form>
        @endif
    </div>
    </div>
    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
