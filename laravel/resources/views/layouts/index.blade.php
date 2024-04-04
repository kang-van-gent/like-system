@extends('layouts')
@section('contents')


@if(Session::has('error'))
<p class="text-danger"> {{session('error')}}</p>
@endif
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
  <!-- Sidebar Start -->
  <aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="./index.html" class="text-nowrap logo-img">
          <img src="/assets/images/logos/dark-logo.svg" width="180" alt="" />
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/" aria-expanded="false">
              <span>
                <i class="ti ti-layout-dashboard"></i>
              </span>
              <span class="hide-menu">Dashboard</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/farm" aria-expanded="false">
              <span>
                <i class="ti ti-layout-dashboard"></i>
              </span>
              <span class="hide-menu">My Farm</span>
            </a>
          </li>

        </ul>
        <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
          <div class="d-flex">
            <div class="unlimited-access-title me-3">
              <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Upgrade to pro</h6>
              <a href="/" class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
            </div>
            <div class="unlimited-access-img">
              <img src="/assets/images/backgrounds/rocket.png" alt="" class="img-fluid">
            </div>
          </div>
        </div>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>
  <!--  Sidebar End -->
  <!--  Main wrapper -->
  <div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header">
      <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item d-block d-xl-none">
            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
              <i class="ti ti-menu-2"></i>
            </a>
          </li>

        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
          <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

            <li class="nav-item dropdown">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="/assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                <div class="message-body">
                  <a href="/add-account" class="d-flex align-items-center gap-2 dropdown-item">
                    <i class="ti ti-mail fs-6"></i>
                    <p class="mb-0 fs-3">Add Account</p>
                  </a>

                  <a href="{{url('/logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!--  Header End -->
    <div class="container-fluid">
      <!--  Row 1 -->
      <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
          <div class="card w-100">
            <div class="card-body">
              <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                <div class="mb-3 mb-sm-0">
                  <h5 class="card-title fw-semibold">Panel</h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal1" type="button">IMPORT FARM</button>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">ADD SERVICE</button>
                  </div>

                  <form method="post" action="{{url('/services')}}">@csrf
                    <div class="mb-3">
                      <label for="disabledSelect" class="form-label">Select service</label>
                      <select id="disabledSelect" class="form-select" name="apiUrl">
                        @if($services)
                        @foreach($services as $s)
                        <option value="{{$s->apiUrl}}">{{$s->name}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="fabook" class="form-label">Facebook UID</label>
                      <input type="text" class="form-control" name="facebook" id="fabook">
                    </div>
                    <div class="mb-3">
                      <label for="amount" class="form-label">Amount</label>
                      <input type="number" class="form-control" name="amount" id="amount">
                    </div>

                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body p-4">
              <h5 class="card-title fw-semibold mb-4">Status</h5>
              <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Id</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Facebook</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Status</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Amount</h6>
                      </th>
                    </tr>
                  </thead>

                  <tbody>
                    @if($history)
                    @foreach($history as $h)
                    <tr>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">{{$h->id}}</h6>
                      </td>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">{{$h->facebookUrl}}</h6>
                        <span class="fw-normal">{{$h->facebookId}}</span>
                      </td>

                      <td class="border-bottom-0">
                        <div class="d-flex align-items-center gap-2">
                          <span @if($h->status=='done' || $h->status=='Done') class="badge bg-success rounded-3 fw-semibold" @elseif($h->status=='on going..') class="badge bg-warning rounded-3 fw-semibold" @else class="badge bg-warning rounded-3 fw-semibold" @endif>{{$h->status}}</span>
                        </div>
                      </td>

                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-0 fs-4">{{$h->success}} / {{$h->amount}}</h6>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>



<!-- Modal for new api service -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="{{url('/new-services')}}">@csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add API services</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="service-name" class="form-label">Service's name</label>
            <input type="text" name="name" class="form-control" id="service-name" aria-describedby="emailHelp" placeholder="Service's name">
          </div>
          <div class="mb-3">
            <label for="api-url" class="form-label">API's end-point</label>
            <input type="text" name="apiUrl" class="form-control" id="api-url" aria-describedby="emailHelp" placeholder="https://example.com/api">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Connect</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal for import new facebook farm-->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="{{url('/new-farm')}}">@csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Import New facebook farm</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <textarea class="form-control" id="exampleFormControlTextarea1" name="facebookFarm" rows="10"></textarea>
            <span>Past notepad text here.</span><br>
            <span>Pattern : <br> uid | token | cookie |||</span>
          </div>
        </div>
        <div class="mb-3">
          <label for="disabledSelect" class="form-label">Select service</label>
          <select id="disabledSelect" class="form-select" name="type">

            <option value="ไทย">ไทย</option>
            <option value="ต่างชาติ">ต่างชาติ</option>

          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="sunmit" class="btn btn-primary">Connect</button>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection