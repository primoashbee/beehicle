@extends('layouts.appv1')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">Table Basic</h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>Owner</th>
              <th>Brand</th>
              <th>Plate #</th>
              <th>Vehicle Type</th>
              <th>Date Purchased</th>
              <th>Chasis</th>
              <th>Coding</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($vehicles as $key=>$vehicle)
            <tr>
              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$vehicle->user->name}}</strong></td>
              <td>
                {{$vehicle->brand}}
              </td>
              <td>
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
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->

</div>
@endsection