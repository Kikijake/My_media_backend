@extends('admin.layout.app')
@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">User Profile</legend>
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
                            <form class="form-horizontal" action="{{ route('admin#update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='adminName' class="form-control" id="inputName" placeholder="Name"
                                            value="{{ old('adminName',$userInfo->name )}}">
                                        @error('adminName')
                                            <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="adminEmail" class="form-control" id="inputEmail" placeholder="Email"
                                            value="{{ old('adminEmail',$userInfo->email) }}">
                                        @error('adminEmail')
                                            <small class=" text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="adminPhone" class="form-control" id="inputEmail" placeholder="Phone"
                                            value="{{ $userInfo->phone }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="adminAddress" id="" cols="30" rows="5" placeholder="Address">{{ $userInfo->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Gendar</label>
                                    <div class="col-sm-10">
                                        <select name="adminGender" id="" class=" form-control w-50">
                                            <option value="empty">Choose Gender</option>
                                            <option value="male" @if ($userInfo->gender == 'male') selected @endif>
                                                Male</option>
                                            <option value="female" @if ($userInfo->gender == 'female') selected @endif>
                                                Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <a href="{{route('admin#changePasswordPg')}}">Change Password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
