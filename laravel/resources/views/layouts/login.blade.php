@extends('layouts')
@section('contents')

@if(Session::has('adminData'))
<script type="text/javascript">
  window.location.href = "{{url('/')}}";
</script>
@endif
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
  <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
      <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xxl-3">
          <div class="card mb-0">
            <div class="card-body">
              <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
              </a>
              <p class="text-center">Your Social Campaigns</p>
              <form class="user" method="post" action="{{url('/admin/login')}}">
                @csrf
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" @if(Cookie::has('adminuser')) value="{{Cookie::get('adminuser')}}" @endif aria-describedby="emailHelp">
                </div>
                <div class="mb-4">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" @if(Cookie::has('adminpwd')) value="{{Cookie::get('adminpwd')}}" @endif name="password">
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                  <div class="form-check">
                    <input class="form-check-input primary" type="checkbox" name="rememberme" id="flexCheckChecked" @if(Cookie::has('adminuser')) checked @endif>
                    <label class="form-check-label text-dark" for="flexCheckChecked">
                      Remeber this Device
                    </label>
                  </div>
                  <!-- <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a> -->
                </div>
                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                @if(Session::has('msg'))
                <p class="text-danger"> {{session('msg')}}</p>
                @endif

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection