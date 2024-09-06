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
        <form action="{{route('user.processEdit',$project->id)}}" method="post" enctype="multipart/form-data" >
            @csrf
            @method('put')
            <div>
                <label class="form-label text-white">Project-Name</label>
                <input type="text" name="project_name" value="{{ old('project_name', $project->name) }}"
                    class="@error('project_name')
        is-invalid
    @enderror form-control">
                @error('project_name')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="form-label text-white">Upload Your Projects</label>
                <input type="file" name="file" class="@error('file')
    is-invalid
@enderror form-control">
                @error('file')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="form-label text-white">Upload Your Project Image</label>
                <input type="file" name="image" class="@error('image')
    is-invalid
@enderror form-control">
                @error('image')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="profile_id" value="{{ Auth::user()->profile->id }}">
            </div>
            <button class="btn btn-success mt-3 form-control">Update</button>
    </div>
    </div>
    </div>
    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
