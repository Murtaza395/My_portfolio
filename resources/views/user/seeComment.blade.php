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

        .margin {
            margin-left: 300px;
        }

        .bord {
            border-radius: 40px;
        }
    </style>
</head>

<body>
    @include('layouts.header')
    @include('layouts.message')
    @include('layouts.profile')
    <div class="container text-white bg-dark mt-4 ms-3 d-flex">
        <div>
            @if (Auth::check())
                <a href="{{ route('user.allProjects', Auth::user()->id) }}" class="btn btn-success mt-2">Back</a>
            @endif
        </div>
        <div class="margin">
            @if ($cmt > 0)
                @foreach ($comment as $comments)
                    <a href="{{ route('user.otherProfile', $comments->user_id) }}">
                        <div class="d-flex">
                            <img src="{{ asset('uploads/profile/thumb/' . $comments->user->profile_pic) }}"
                                class="mt-2 bord" width=40 alt="">
                            <p class="mt-3 ms-2">{{ $comments->user->name }}</p>
                        </div>
                    </a>
                    <p class="text-white">{{ $comments->comment }}</p>
                    <form action="{{ route('user.deleteComment', $comments->id) }}"
                        id="deleteCommentFrom{{ $comments->id }}" method="post">
                        @method('delete')
                        @csrf
                        @if (Auth::user()->id == $comments->project->user_id || Auth::user()->id == $comments->user_id)
                            <a href="#" onClick="deleteComment({{ $comments->id }})"
                                class="text-danger">Delete</a>
                        @endif
                    </form>
                @endforeach
            @else
                <h1 class="text-white text-center d">No Comments Found</h1><br>
                <p class="text-white text-center ">Be the first one to post a comment</p>
            @endif
        </div>
    </div>
    </div>
    @include('layouts.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        function deleteComment(id) {
            if (confirm("Are you sure to delete this?")) {
                document.getElementById("deleteCommentFrom" + id).submit();
            }
        }
    </script>
</body>

</html>
