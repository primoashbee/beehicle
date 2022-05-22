@extends('layouts.appv1')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Dashboard</h5>
      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

          <div class="col-lg-12 col-md-6">
            <div class="row">
              <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img
                          src="../assets/img/icons/unicons/chart-success.png"
                          alt="chart success"
                          class="rounded"
                        />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt3"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                          <a class="dropdown-item" href="javascript:void(0);">View More</a>
                          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Users</span>
                    <h3 class="card-title mb-2">{{$total_users}}</h3>
                    {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img
                          src="../assets/img/icons/unicons/wallet-info.png"
                          alt="Credit Card"
                          class="rounded"
                        />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt6"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                          <a class="dropdown-item" href="javascript:void(0);">View More</a>
                          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </div>
                    <span>Vehicles</span>
                    <h3 class="card-title text-nowrap mb-1">{{$total_vehicles}}</h3>
                    {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-6">
            <div class="row">
              <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img
                          src="../assets/img/icons/unicons/chart-success.png"
                          alt="chart success"
                          class="rounded"
                        />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt3"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                          <a class="dropdown-item" href="javascript:void(0);">View More</a>
                          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Transactions</span>
                    <h3 class="card-title mb-2">{{$total_transactions}}</h3>
                    {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img
                          src="../assets/img/icons/unicons/wallet-info.png"
                          alt="Credit Card"
                          class="rounded"
                        />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt6"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                          <a class="dropdown-item" href="javascript:void(0);">View More</a>
                          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </div>
                    <span>Services</span>
                    <h3 class="card-title text-nowrap mb-1">{{$total_services}}</h3>
                    {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>

      </div>
    </div>
    <!--/ Basic Bootstrap Table -->

</div>
@endsection