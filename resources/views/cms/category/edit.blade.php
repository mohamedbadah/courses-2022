@extends('cms.parent');
@section('title','category')
@section('title-sub','update category')
@section('content')
<section class="content">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Update category</h3>
        </div>
        <!-- /.card-header -->
        @if ($errors->any())
        <div class="mt-4 alert alert-danger">
        <ul>
            @foreach ($errors->all() as $erorr)
                <li>{{$erorr}}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <!-- form start -->
        <form action="{{route("category.update",$category->id)}}" method="POST">
            @csrf
            @method("PUT")
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">name</label>
              <input type="text" name="name" value="{{$category->name}}" class="form-control" id="exampleInputEmail1" placeholder="Enter name category">
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-warning">update</button>
          </div>
        </form>
      </div>
</section>
@endsection