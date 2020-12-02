@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">

        @if(session('success_slider'))
          <div class="alert alert-success mb-5">
              <strong>{{session('success_slider')}}</strong>
          </div>
        @endif
            @if(session('error_slider'))
                <div class="alert alert-danger mb-5">
                    <strong>{{session('error_slider')}}</strong>
                </div>
            @endif

        <a href="{{route('slider.create')}}" class="btn btn-success mb-4">CREATE</a>
        @if(count($sliderList))
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Create Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @php $i=1; @endphp

               @foreach($sliderList as $slider)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$slider->title}}</td>
                    <td>
                        <img src="{{asset($slider->image)}}" width="100" class="img-thumbnail" alt="">
                        </td>
                    <td>{{$slider->created_at}}</td>
                    <td>
                        <a href="{{route('slider.edit',['id'=>$slider->id])}}" class="btn btn-info btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{route('slider.delete',['id'=>$slider->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('CONFIRM DELETE')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @php $i++; @endphp
               @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <!-- /.card-body -->
    <div class="card-footer">

         {{$sliderList->links()}}

    </div>
@endsection
