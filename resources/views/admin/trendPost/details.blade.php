@extends('admin.layout.app')
@section('content')
    <div class="col-6 offset-3 mt-5">
        <div class="card">
            <a href="{{route('admin#trendPost')}}" class=" btn btn-dark w-25 m-2"><i class="fa-solid fa-arrow-left"></i> Back</a>
            <div class="card-header d-flex justify-content-center">
                @if ($post->image == null)
                    <div style="height: 50px;">
                        No Image
                    </div>
                @else
                    <img src="{{ asset('postImage/' . $post->image) }}" class=" shadow w-50" alt="News Image"
                        style="object-fit:cover;over-flow:hidden">
                @endif
            </div>
            <div class=" card-body">
                <h3 class=" text-center">{{ $post->title }}</h3>
                <p class=" text-start">{{ $post->description }}</p>
            </div>
        </div>
        <!-- /.card -->
    </div>
@endsection
