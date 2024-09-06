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
                    @if (Auth::check())
                        <form action="{{ route('admin.updatePass', Auth::user()->id) }}" method="post">
                            @csrf
                            @method('put')
                    @endif
                    <label class="form-label text-white">Current Password</label>
                    <input type="password" name="current_password"
                        class="@error('current_password') is-invalid @enderror form-control border border-light">
                    @error('current_password')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    <label class="form-label text-white">New Password</label>
                    <input type="password" name="password" class="@error('password') is-invalid @enderror form-control border border-light">
                    @error('password')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    <label class="form-label text-white">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="@error('password_confirmation') is-invalid @enderror form-control border border-light">
                    @error('password_confirmation')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    <button class="btn btn-dark form-control text-white">Update Password</button>
                    </form>
                </div>
            </div>
            <!-- JavaScript files-->
            <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
            <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
            <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
            <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
            <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
            <script src="{{ asset('admincss/js/front.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
</body>

</html>
