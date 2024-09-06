
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
          <div class="page-header bg-dark text-light">
            <div class="container-fluid">
                <form class="d-flex mb-3" role="search">
                    @csrf
                    <input class="form-control me-2 mt-2 border border-white" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success mt-2" type="submit">Search</button>
                </form>
            <div class="page-header bg-dark text-light">
                <div class="container-fluid">
                        @foreach ($project as $pro)
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
                                <img src="{{asset('uploads/projects/thumb/'.$pro->image)}}">
                                </div>
        
                            </div>  
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="mt-3">Download</label>
                                </div>
                                <div class="col-md-6">
                                <a href="{{ url('/uploads/files/' . $pro->file) }}" class="btn btn-success mt-3" download>Download Project</a>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="mt-3">Action</label>
                                </div>
                                <div class="col-md-6">
                               <form action="{{route('admin.deleteProject',$pro->id)}}" method="post" id="deleteProjectFrom{{$pro->id}}">
                                @method('delete')
                                @csrf
                               <a href="#" onClick="handleDelete({{$pro->id}})" class="btn btn-danger mt-2">Delete</a>
                            </form>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="mt-3">Comments</label>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('admin.seeComment',$pro->id)}}" class="btn btn-primary mt-2">See all comments</a>                                     
                                </div>
                            </div> 
                            <div class="col-md-14 bg-warning text-center mt-2">
                                ...............................................
                            </div>
                        @endforeach
                    {{$project->links()}}
            </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        
      </div>
    <!-- JavaScript files-->
    <script>
        function handleDelete(id){
            if(confirm("Are you sure to delete?")){
                document.getElementById("deleteProjectFrom"+id).submit();
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
