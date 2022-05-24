@extends('layouts.appv1')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Information /</span> Users</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header">List of Users</h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th># of Vehicles</th>
              <th>Status</th>
              <th>Created At</th>

              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach($users as $key=>$user)
            <tr>
              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$user->name}}</strong></td>
              <td>{{$user->email}}</td>
              <td>
                {{$user->vehicles()->count()}}
              </td>
              <td><span class="badge @if($user->verified) bg-label-success @else bg-label-warning @endif  me-1">{{ $user->verified_status}}</span></td>
              <td><span class="badge bg-label-primary me-1">{{ $user->created_at->diffForHumans()}}</span></td>
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

      <div class="d-flex justify-content-center">

        {!! $users->links() !!}
      </div>

    </div>
    <!--/ Basic Bootstrap Table -->

</div>
@endsection