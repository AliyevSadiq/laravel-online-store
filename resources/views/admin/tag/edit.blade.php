@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">
        <form method="post"  action="{{route('tag.update',['id'=>$tag->id])}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is is-invalid @enderror" id="title" name="title" value="{{$tag->title}}"  >
                @error('title')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is is-invalid @enderror" id="description" name="description" rows="3">{{$tag->description}}</textarea>
                @error('description')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Keyword</label>
                <textarea class="form-control @error('keyword') is is-invalid @enderror" id="keyword" name="keyword" rows="3">{{$tag->keyword}}</textarea>
                @error('keyword')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>

    </div>

@endsection
