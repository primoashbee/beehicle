@extends('layouts.appv1')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    @if(session()->has('status'))
        @if(session()->get('status')['code'] == 200)
        <div class="alert alert-success" role="alert"> {{session()->get('status')['message']}}</div>
        @else
        <div class="alert alert-danger" role="alert"> {{session()->get('status')['message']}}</div>
        @endif
    @endif
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Profile</h5>
            <small class="text-muted float-end">Update Information</small>
          </div>
          <div class="card-body">
            <form action="{{route('profile.update')}}" method="POST">
                @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" id="basic-default-name" placeholder="John Doe" />
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror  
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input
                      type="text"
                      class="form-control  @error('email') is-invalid @enderror"
                      name="email"
                      value="{{$user->email}}"
                    />
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror  
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-phone">Phone No</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control phone-mask @error('phone_number') is-invalid @enderror"
                    name="phone_number"
                    value="{{$user->phone_number}}"
                  />
                  @error('phone_number')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
                  @enderror  
                </div>
              </div>
              <hr>
              <h5 class="mb-4">Password</h5>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-phone">Password</label>
                <div class="col-sm-10">
                  <input
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    value="{{old('password')}}"
                  />
                  @error('password')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
                  @enderror 
                </div>
              </div>              
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-phone">Password Confirmation</label>
                <div class="col-sm-10">
                  <input
                    type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation"
                    value="{{old('password_confirmation')}}"
                  />
                  @error('password_confirmation')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
                  @enderror 
                </div>
              </div>              
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Send</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection