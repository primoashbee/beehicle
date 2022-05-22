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
              <th>Vehicle</th>
              <th>Origin</th>
              <th>Destination</th>
              <th>Odometer</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($transactions as $key=>$transaction)
            <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$transaction->vehicle->user->name}}</strong></td>
                <td>
                    {{$transaction->vehicle->plate_number}}
                </td>
                <td>
                    {{$transaction->from_address}}
                </td>
                <td>
                    {{$transaction->to_address}}
                </td>
                <td>
                    {{$transaction->odometer}}
                </td>
              {{--<td>
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
              <td><span class="badge bg-label-primary me-1">{{ $service->created_at->diffForHumans()}}</span></td> --}}

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