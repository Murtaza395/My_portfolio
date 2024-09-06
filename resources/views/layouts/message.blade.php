@if (Session::has('success'))
          
        
<div class="container">
<p class="alert alert-success alert-dismissible fade show"> {{Session::get('success')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</p>
</div>
@endif
@if (Session::has('error'))
  

<div class="container">
<p class="alert alert-success alert-dismissible fade show"> {{Session::get('error')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</p>
</div>
@endif