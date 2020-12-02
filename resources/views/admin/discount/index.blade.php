@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">

        @if(session('success_discount'))
          <div class="alert alert-success mb-5">
              <strong>{{session('success_discount')}}</strong>
          </div>
        @endif
            @if(session('error_discount'))
                <div class="alert alert-danger mb-5">
                    <strong>{{session('error_discount')}}</strong>
                </div>
            @endif

        <a href="{{route('discount.create')}}" class="btn btn-success mb-4">CREATE</a>
        @if(count($discountList))
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Percent</th>
                    <th>Create Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @php $i=1; @endphp

               @foreach($discountList as $discount)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$discount->title}}</td>
                    <td>{{$discount->percent}} </td>
                    <td>{{$discount->created_at}}</td>
                    <td>
                        <a href="{{route('discount.edit',['id'=>$discount->id])}}" class="btn btn-info btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{route('discount.delete',['id'=>$discount->id])}}" method="post">
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

         {{$discountList->links()}}

    </div>
@endsection
