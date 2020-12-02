@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">

        @if(session('success_tag'))
          <div class="alert alert-success mb-5">
              <strong>{{session('success_tag')}}</strong>
          </div>
        @endif
            @if(session('error_tag'))
                <div class="alert alert-danger mb-5">
                    <strong>{{session('error_tag')}}</strong>
                </div>
            @endif

        <a href="{{route('tag.create')}}" class="btn btn-success mb-4">CREATE</a>
        @if(count($tagList))
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Create Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @php $i=1; @endphp

               @foreach($tagList as $tag)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$tag->title}}</td>
                    <td>{{$tag->created_at}}</td>
                    <td>
                        <a href="{{route('tag.edit',['id'=>$tag->id])}}" class="btn btn-info btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{route('tag.delete',['id'=>$tag->id])}}" method="post">
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

         {{$tagList->links()}}

    </div>
@endsection
