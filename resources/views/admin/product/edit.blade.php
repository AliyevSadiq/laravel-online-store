@extends('layout.admin_layout')

@section('admin_title') @parent {{$title}} @endsection


@section('admin_content')

    <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="{{route('product.update',['id'=>$product->id])}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is is-invalid @enderror" id="title" name="title" value="{{$product->title}}"  >
                @error('title')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="total_count">Total Count</label>
                <input type="text" class="form-control @error('total_count') is is-invalid @enderror" id="total_count" name="total_count" value="{{$product->total_count}}"  >
                @error('total_count')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control @error('price') is is-invalid @enderror" id="price" name="price" value="{{$product->price}}"  >
                @error('price')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control @error('category_id') is is-invalid @enderror" id="category_id" name="category_id">
                    <option selected value="">Select Category</option>
                    @foreach($categories as $key=>$value)
                        <option  @if($product->category_id==$key) selected @endif value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Tags</label>
                <select class="select2 form-control @error('tags.*') is is-invalid @enderror" name="tags[]" multiple="multiple" style="width: 100%;">
                    @foreach($tags as $key=>$value)
                        <option @if(in_array($key,$product->tags->pluck('id')->all())) selected @endif value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
                @error('tags.*')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="discount_id">Discount</label>
                <select class="form-control" id="discount_id" name="discount_id">
                    <option selected value="0">Select Discount</option>
                    @foreach($discountList as $key=>$value)
                        <option  @if($product->discount_id==$key) selected @endif value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>

            </div>

            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" class="form-control @error('thumbnail') is is-invalid @enderror" id="thumbnail" name="thumbnail">
                @error('thumbnail')
                <div class="text-danger">{{$message}}</div>
                @enderror
                <img src="{{asset($product->thumbnail)}}" width="100" class="img-thumbnail" alt="">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control @error('image') is is-invalid @enderror" id="image" name="image">
                @error('image')
                <div class="text-danger">{{$message}}</div>
                @enderror
                <img src="{{asset($product->image)}}" width="100" class="img-thumbnail" alt="">
            </div>

            <div class="form-group">
                <label for="galleries">Gallery</label>
                <input type="file" class="form-control @error('galleries.*') is is-invalid @enderror" multiple id="galleries" name="galleries[]">
                @error('galleries.*')
                <div class="text-danger">{{$message}}</div>
                @enderror

                @foreach($product->galleries as $image)
                    <a href="#" data-image="{{$image->id}}" class="delete_img" title="DELETE IMAGE">
                        <img src="{{asset($image->image)}}"  width="100" class="img-thumbnail" alt="">
                    </a>
                @endforeach
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control @error('content') is is-invalid @enderror" id="content" name="content" rows="3">{{$product->content}}</textarea>
                @error('content')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="seo_description">Seo Description</label>
                <textarea class="form-control @error('seo_description') is is-invalid @enderror" id="seo_description" name="seo_description" rows="3">{{$product->seo_description}}</textarea>
                @error('seo_description')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="seo_keyword">Seo Keyword</label>
                <textarea class="form-control @error('seo_keyword') is is-invalid @enderror" id="seo_keyword" name="seo_keyword" rows="3">{{$product->seo_keyword}}</textarea>
                @error('seo_keyword')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>

    </div>

@endsection
