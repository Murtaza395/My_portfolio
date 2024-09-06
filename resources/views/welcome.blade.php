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
    <div class="container mt-4 ms-3">
        @if ($projcount !=0)
        <form class="d-flex mb-3" role="search">
            @csrf
            <input class="form-control me-2 mt-2 border border-dark" type="search" name="search" placeholder="Search"
                aria-label="Search">
            <button class="btn btn-outline-success mt-2" type="submit">Search</button>
            @if (auth::check())
            <a href="{{ route('user.allProjects', Auth::user()->id) }}"
                class="btn btn-outline-dark mt-2 ms-2">Clear</a>           
             @endif
        </form>
        <div class="page-header bg-dark text-light">
            <div class="container-fluid">
                    @foreach ($project as $pro)
                        <div class="row">
                            <div class="col-md-6">
                                <label>Project Owner</label>
                            </div>
                            <div class="col-md-6">
                                <p><b>{{ $pro->user->name }}</b></p>
                            </div>
                        </div>
                        <div class="row">
                            @if (Auth::check())
                            <div class="col-md-6">
                                <label>Profile</label>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset('uploads/profile/thumb/' . $pro->user->profile_pic) }}"
                                    alt="">                                           
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Project Name</label>
                            </div>
                            <div class="col-md-6">
                                <p><b>{{ $pro->name }}</b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Created at</label>
                            </div>
                            <div class="col-md-6">
                                <p><b>{{ \carbon\carbon::parse($pro->created_at)->format('d M,Y') }}</b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Project View</label>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('user.seeComment',$pro->id)}}">
                                    <img src="{{ asset('uploads/projects/thumb/' . $pro->image) }}">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mt-3">Download</label>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/uploads/files/' . $pro->file) }}" class="btn btn-success mt-3"
                                    download>Download Project</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mt-3">Comment</label>
                            </div>
                            <div class="col-md-6">
                                @if (Auth::check())
                                <form action="{{ route('user.postComment',Auth::user()->id) }}" method="post">
                                    @csrf
                                    <input type="text" name="comment"
                                        class="@error('comment') is-invalid @enderror form-control mt-2">
                                    @error('comment')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-success mt-2">Post a Comment</button>
                                        @else
                                        <p class="mt-2">Please Login to post a comment</p>
                                        @endif
                                        <a href="{{route('user.seeComment',$pro->id )}}" class="btn btn-primary mt-2">See all Comments</a>
                                        @if (Auth::check())
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="profile_id" value="{{ $pro->profile->id }}">
                                        <input type="hidden" name="project_id" value="{{ $pro->id }}">   
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-14 bg-warning text-center mt-2">
                            ...............................................
                        </div>
                    @endforeach
                @else
                    <div class="container bg-dark text-white">
                        <h1>Please upload projects to view</h1>
                        <a href="{{ route('user.uploadproject', Auth::user()->id) }}"
                            class="btn btn-primary mb-2">Upload
                            Project</a>
                    </div>
                @endif
                {{ $project->links() }}
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
