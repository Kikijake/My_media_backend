@extends('admin.layout.app')
@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post Table</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Post Title</th>
              <th>Post Image</th>
              <th>View Count</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>
                        @if ($item->image == null)
                            <div style="height: 50px;">
                                No Image
                            </div>
                        @else
                            <img
                            src="{{asset('postImage/'.$item->image)}}"
                            class=" shadow"
                            alt="News Image"
                            style="width: 50px;height:50px;object-fit:cover;over-flow:hidden">
                        @endif
                    </td>
                    <td><i class="fa-solid fa-eye"></i>{{$item->viewCount}}</td>
                    <td>
                        <a href="{{route('admin#trendPost#details',$item->post_id)}}" class="btn btn-sm bg-dark text-white"><i class="fa-regular fa-file-lines"></i></a>
                    </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class=" d-flex justify-content-center">
            {{-- {{$posts->links()}} --}}
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
