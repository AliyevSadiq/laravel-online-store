@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{route('category.store')}}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is is-invalid @enderror" id="title" name="title" value="{{old('title')}}"  >
                @error('title')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control @error('image') is is-invalid @enderror" id="image" name="image">
                @error('image')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is is-invalid @enderror" id="description" name="description" rows="3">{{old('description')}}</textarea>
                @error('description')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="keyword">Keyword</label>
                <textarea class="form-control @error('keyword') is is-invalid @enderror" id="keyword" name="keyword" rows="3">{{old('keyword')}}</textarea>
                @error('keyword')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">CREATE</button>
        </form>

    </div>

@endsection
