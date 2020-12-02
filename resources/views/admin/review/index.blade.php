@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">

        @if(session('success_review'))
          <div class="alert alert-success mb-5">
              <strong>{{session('success_review')}}</strong>
          </div>
        @endif
            @if(session('error_review'))
                <div class="alert alert-danger mb-5">
                    <strong>{{session('error_review')}}</strong>
                </div>
            @endif


        @if(count($reviewList))
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Product</th>
                    <th>Status</th>
                    <th>Create Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @php $i=1; @endphp

               @foreach($reviewList as $review)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$review->name}}</td>
                    <td>{{$review->email}}</td>
                    <td>{{$review->product->title}}</td>

                    @if($review->is_active)
                        <td><p class="text-success">ACTIVE</p></td>
                    @else
                        <td><p class="text-danger">DE ACTIVE</p></td>
                    @endif


                    <td>{{$review->created_at}}</td>
                    <td>
                        <a href="{{route('review.edit',['id'=>$review->id])}}" class="btn btn-info btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{route('review.delete',['id'=>$review->id])}}" method="post">
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

         {{$reviewList->links()}}

    </div>
@endsection
