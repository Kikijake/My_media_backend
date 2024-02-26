@extends('admin.layout.app')
@section('content')
<div class="col-12">
    {{-- ALERT START --}}
    @if (session('deleteSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('deleteSuccess')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    {{-- ALERT END --}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List Table</h3>

        <div class="card-tools">
            <form action="{{route('admin#list')}}" method="GET">
                @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" value="{{$adminSearchKey}}" name="adminSearchKey" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
            </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Gender</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td> {{$user->name}} </td>
                    <td> {{$user->email}} </td>
                    <td> {{$user->phone}} </td>
                    <td> {{$user->address}} </td>
                    <td> {{$user->gender}} </td>
                    <td>
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                        @if ($user->id != Auth::user()->id)
                            <a href="{{route('admin#list#delete',$user->id)}}" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
