<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
  </head>
  <body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
          <div class="page-header color text-light">
            <div class="container-fluid">
                <div class="container text-white bg-dark mt-4 ms-3 d-flex">
                    <div>
                        @if (Auth::guard('admin')->check())
                        @foreach ($pro as $pros)
                            <a href="{{ route('admin.allProjects',$pros->id) }}" class="btn btn-success mt-2">Back</a>                                            
                        @endforeach
                        @endif
                    </div>
                    <div class="margin ms-5">
                            @foreach ($comment as $comments)
                                {{--<a href="{{ route('admin.otherProfile', $comments->user_id) }}">--}}
                                    <div class="d-flex">
                                        <img src="{{ asset('uploads/profile/thumb/' . $comments->user->profile_pic) }}"
                                            class="mt-2 bord" width=40 alt="">
                                        <p class="mt-3 ms-2">{{ $comments->user->name }}</p>
                                    </div>
                                </a>
                                <p class="text-white">{{ $comments->comment }}</p>
                                <form action="{{ route('admin.deleteComment', $comments->id) }}"
                                    id="deleteCommentFrom{{ $comments->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                        <a href="#" onClick="deleteComment({{ $comments->id }})"
                                            class="text-danger">Delete</a>
                                </form>
                            @endforeach
                    </div>
                </div>
        </div>
      </div>
    <!-- JavaScript files-->
    <script>
        function deleteComment(id) {
            if (confirm("Are you sure to delete this?")) {
                document.getElementById("deleteCommentFrom" + id).submit();
            }
        }
    </script>
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
