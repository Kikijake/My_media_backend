@extends('admin.layout.app')
@section('content')
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <div>
                <h5>Create Category:</h5>
            </div>
            <form action="{{route('admin#category#create')}}" method="POST">
                @csrf
                <div class=" form-group">
                    <div>
                        <label for="">Category</label>
                        <input type="text" name="categoryName" class=" form-control" placeholder="Enter Category Name">
                        @error('categoryName')
                            <small class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="">Description</label>
                        <textarea name="categoryDescription" class=" form-control" cols="30" rows="10" placeholder="Enter Description"></textarea>
                        @error('categoryDescription')
                            <small class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-8">
    {{-- ALERT START --}}
    @if (session('deleteSuccess'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{session('deleteSuccess')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    {{-- ALERT END --}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Category Table</h3>

        <div class="card-tools">
            <form action="{{route('admin#category')}}" method="GET">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" value="{{$categorySearch}}" name="categorySearch" class="form-control float-right" placeholder="Search">

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
              <th>Category ID</th>
              <th>Category Name</th>
              <th>Descripiton</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($category as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->title}}</td>
                    <td>{{$c->description}}</td>
                    <td>
                        <a href="{{route('admin#category#editPage',['id' => $c->id])}}" class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></a>
                        <a href="{{route('admin#category#delete',$c->id)}}" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
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
