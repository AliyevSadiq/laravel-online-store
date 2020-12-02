@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{route('slider.update',['id'=>$slider->id])}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is is-invalid @enderror" id="title" name="title" value="{{$slider->title}}"  >
                @error('title')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="slider_url">Url</label>
                <input type="text" class="form-control @error('slider_url') is is-invalid @enderror" id="slider_url" name="slider_url" value="{{$slider->slider_url}}"  >
                @error('slider_url')
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
                <textarea class="form-control @error('description') is is-invalid @enderror" id="description" name="description" rows="3">{{$slider->description}}</textarea>
                @error('description')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>

    </div>

@endsection
