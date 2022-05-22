@extends('layouts.appv1')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Information /</span> Services</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">List of Services</h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>Owner</th>
              <th>Vehicle</th>
              <th>Name</th>
              <th>Cost</th>
              <th>Date</th>
              <th>Provider</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($services as $key=>$service)
            <tr>
              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$service->vehicle->user->name}}</strong></td>
              <td>
                {{$service->vehicle->plate_number}}
              </td>
              <td>
                {{$service->name}}
              </td>
              <td>
                ₱ {{number_format($service->cost)}}
              </td>
              <td>
                {{$service->date}}
              </td>
              <td>
                {{$service->provider->name}}
              </td>
              <td><span class="badge bg-label-primary me-1">{{ $service->created_at->diffForHumans()}}</span></td>

              {{-- <td>
                {{$vehicle->plate_number}}
              </td>
              <td>
                {{$vehicle->vehicle_type}}
              </td>
              <td>
                {{$vehicle->date_purchased->toDateString()}}
              </td>
              <td>
                {{$vehicle->chasis}}
              </td>
              <td>
                {{$vehicle->coding}}
              </td>
              <td><span class="badge bg-label-primary me-1">{{ $vehicle->created_at->diffForHumans()}}</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"
                      ><i class="bx bx-edit-alt me-1"></i> Edit</a
                    >
                    <a class="dropdown-item" href="javascript:void(0);"
                      ><i class="bx bx-trash me-1"></i> Delete</a
                    >
                  </div>
                </div>
              </td> --}}
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->

</div>
@endsection