@extends('cms.parent');
@section('title','category')
@section('title-sub','create category')
@section('content')
<section class="content">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">create category</h3>
        </div>
        <!-- /.card-header -->
       @include('cms.layout.error');
        <!-- form start -->
        <form action="{{route("category.store")}}" method="POST">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">name</label>
              <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name category">
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
</section>
@endsection