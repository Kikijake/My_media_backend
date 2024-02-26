@extends('admin.layout.app')
@section('content')
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <div>
                <h5>Create Post:</h5>
            </div>
            <form action="{{route('admin#post#create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div>
                        <label for="">Title</label>
                        <input type="text" name="postTitle" class=" form-control" placeholder="Enter Category Name" value="{{old('postTitle')}}">
                        @error('postTitle')
                            <small class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="" class=" form-label">Description</label>
                        <textarea name="postDescription" class="form-control" cols="30" rows="10"
                        placeholder="Enter Description">{{old('postDescription')}}</textarea>
                        @error('postDescription')
                            <small class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="">
                        <label for="" class=" form-label">Image</label>
                        <div id="image-container">
                            <img src="{{asset('postImage/AddImage.png')}}" id="uploaded-image" alt="Uploaded Image"
                            class="w-50 object-cover img-thumbnail shadow">
                        </div>
                        <input class=" form-control mt-2" type="file" name="postImage" value="{{old('postImage')}}" id="image-input" accept="image/*" onchange="displayImage()">
                        @error('postImage')
                            <small class=" text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="">Category Name</label>
                        <select name="postCategory" id="" class="form-control">
                            <option value="{{Null}}">Choose Category...</option>
                            @foreach ($category as $c )
                                @if ($c->id == old('postCategory'))
                                <option value="{{$c->id}}" selected>{{$c->title}}</option>
                                @else
                                <option value="{{$c->id}}">{{$c->title}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('postCategory')
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
            <form action="" method="GET">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" value="" name="categorySearch" class="form-control float-right" placeholder="Search">

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
              <th>Post ID</th>
              <th>Post Title</th>
              <th>Image</th>
              <th></th>
          </thead>
          <tbody>
            @foreach ($post as $p)
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->title}}</td>
                    <td>
                        @if ($p->image == null)
                            <div style="height: 50px;">
                                No Image
                            </div>
                        @else
                            <img
                            src="{{asset('postImage/'.$p->image)}}"
                            class=" shadow"
                            alt="News Image"
                            style="width: 50px;height:50px;object-fit:cover;over-flow:hidden">
                        @endif
                    </td>
                    <td>
                        <a href="{{route('admin#post#editPage',['id' => $p->id])}}" class="btn btn-sm bg-dark text-white"><i class="fas fa-eye"></i></a>
                        <a href="{{route('admin#post#editPage',['id' => $p->id])}}" class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></a>
                        <a href="{{route('admin#post#delete',$p->id)}}" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
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
  <script>
    function displayImage() {
      const input = document.getElementById('image-input');
      const container = document.getElementById('image-container');
      const img = document.getElementById('uploaded-image');

      const file = input.files[0];
      if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
          img.src = e.target.result;
          container.style.display = 'block';
        };

        reader.readAsDataURL(file);
      }
    }
  </script>
@endsection
