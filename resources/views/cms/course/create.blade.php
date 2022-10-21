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
        <form action="{{route("course.store")}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">name</label>
              <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name category">
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">content</label>
              {{-- <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name category"> --}}
              <textarea cols="100" rows="5" class="form-control" name="content"></textarea>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">image</label>
              <input type="file" name="image" class="form-control">
              
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <select name="category" class="form-control">
                @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>  
                @endforeach
              </select>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
</section>
@endsection