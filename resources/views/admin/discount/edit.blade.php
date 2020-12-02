@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">
        <form method="post"  action="{{route('discount.update',['id'=>$discount->id])}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is is-invalid @enderror" id="title" name="title" value="{{$discount->title}}"  >
                @error('title')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="percent">Percent</label>
                <input type="text" class="form-control @error('percent') is is-invalid @enderror" id="percent" name="percent" value="{{$discount->percent}}"  >
                @error('percent')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="expired_date">Expire Date</label>
                <input type="date" class="form-control @error('expired_date') is is-invalid @enderror" id="expired_date" name="expired_date" value="{{$discount->expired_date}}"  >
                @error('expired_date')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>

    </div>

@endsection
