@extends('supervisor.supervisor_dashboard')
@section('supervisor')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Change Password</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('supervisor.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ Auth::user()->sex == "wanita" ? asset('backend/assets/images/avatars/noavatar64f.png') : asset('backend/assets/images/avatars/noavatar64.png')}}" alt="supervisor"
                                    class="rounded-circle p-1 bg-primary" width="110">
                                <h2 class="pt-2 mb-0">{{Auth::user()->name}}</h2>
                                <p>{{Auth::user()->role}} | {{Auth::user()->sex}}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">

                        <form method="POST" action="{{route('supervisor.password.update')}}" enctype="multipart/form-data">
                            @csrf


                            <div class="card-body">


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Old Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="old_password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            id="old_password" />
                                        @error('old_password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">New Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="new_password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            id="new_password" />
                                        @error('new_password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Confirm New Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="new_password_confirmation"
                                            id="new_password_confirmation"
                                            class="form-control @error('new_password_confirmation') is-invalid @enderror" />
                                    </div>

                                    @error('new_password_confirmation')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>


                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection