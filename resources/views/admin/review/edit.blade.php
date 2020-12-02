@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">
        <form method="post"  action="{{route('review.update',['id'=>$review->id])}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" readonly  id="name" name="name" value="{{$review->name}}"  >
            </div>
            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" class="form-control" readonly  id="email" name="email" value="{{$review->email}}"  >
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea  id="message" class="form-control" name="message" readonly rows="3">{{$review->message}}</textarea>
            </div>


            <div class="form-group">
                <label for="is_active">Activate Review</label>
                <select class="form-control" id="is_active" name="is_active">
                    @if($review->is_active)
                    @php $selected_active='selected';  @endphp
                    @php $selected='';  @endphp
                    @else
                        @php $selected_active='';  @endphp
                        @php $selected='selected';  @endphp
                    @endif
                        <option {{$selected_active}} {{$selected}} value="0">DeActive</option>
                        <option {{$selected_active}} {{$selected}} value="1">Active</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>

    </div>

@endsection
