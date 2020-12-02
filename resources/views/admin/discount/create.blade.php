@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">
        <form method="post"  action="{{route('discount.store')}}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is is-invalid @enderror" id="title" name="title" value="{{old('title')}}"  >
                @error('title')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="percent">Percent</label>
                <input type="text" class="form-control @error('percent') is is-invalid @enderror" id="percent" name="percent" value="{{old('percent')}}"  >
                @error('percent')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="expired_date">Expire Date</label>
                <input type="date" class="form-control @error('expired_date') is is-invalid @enderror" id="expired_date" name="expired_date" value="{{old('expired_date')}}"  >
                @error('expired_date')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">CREATE</button>
        </form>

    </div>

@endsection
