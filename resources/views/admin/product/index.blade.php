@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">

        @if(session('success_product'))
          <div class="alert alert-success mb-5">
              <strong>{{session('success_product')}}</strong>
          </div>
        @endif
            @if(session('error_product'))
                <div class="alert alert-danger mb-5">
                    <strong>{{session('error_product')}}</strong>
                </div>
            @endif

        <a href="{{route('product.create')}}" class="btn btn-success mb-4">CREATE</a>
        @if(count($productList))


            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Tags</th>
                    <th>Create Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @php $i=1; @endphp

               @foreach($productList as $product)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$product->title}}</td>
                    <td>
                        <img src="{{asset($product->image)}}" width="100" class="img-thumbnail" alt="">
                        </td>
                    <td>{{$product->category->title}}</td>
                    <td>{{$product->tags()->pluck('title')->join(", ")}}</td>
                    <td>{{$product->created_at}}</td>
                    <td>
                        <a href="{{route('product.edit',['id'=>$product->id])}}" class="btn btn-info btn-sm float-left mr-1">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{route('product.delete',['id'=>$product->id])}}" method="post">
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

         {{$productList->links()}}

    </div>
@endsection
