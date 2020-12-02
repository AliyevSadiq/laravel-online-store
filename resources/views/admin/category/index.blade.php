@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">

        @if(session('success_category'))
          <div class="alert alert-success mb-5">
              <strong>{{session('success_category')}}</strong>
          </div>
        @endif
            @if(session('error_category'))
                <div class="alert alert-danger mb-5">
                    <strong>{{session('error_category')}}</strong>
                </div>
            @endif

        <a href="{{route('category.create')}}" class="btn btn-success mb-4">CREATE</a>
        @if(count($categoryList))
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

               @foreach($categoryList as $category)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$category->title}}</td>
                    <td>
                        <img src="{{asset($category->image)}}" width="100" class="img-thumbnail" alt="">
                        </td>
                    <td>{{$category->created_at}}</td>
                    <td>
                        <a href="{{route('category.edit',['id'=>$category->id])}}" class="btn btn-info btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{route('category.delete',['id'=>$category->id])}}" method="post">
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

         {{$categoryList->links()}}

    </div>
@endsection
