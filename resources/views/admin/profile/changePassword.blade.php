@extends('admin.layout.app')
@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            {{-- ALERT START --}}
                            @if (session('updateSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('updateSuccess')}}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- ALERT END --}}
                            <form class="form-horizontal" action="{{ route('admin#changePassword') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="oldName" class="col-sm-3 col-form-label">Old Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name='oldPassword' class="form-control" id="oldName" placeholder="Enter your old password"
                                            value="">
                                        @error('oldPassword')
                                            <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                        @if (session('fail'))
                                            <small class=" text-danger">{{session('fail')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="newPassword" class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="newPassword" class="form-control" id="inputEmail" placeholder="Enter your new password"
                                            value="">
                                        @error('newPassword')
                                            <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="oldPassword" class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="confirmPassword" class="form-control" id="inputEmail" placeholder="Enter your confirm password"
                                            value="">
                                        @error('confirmPassword')
                                            <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white">Change Password</button>
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
