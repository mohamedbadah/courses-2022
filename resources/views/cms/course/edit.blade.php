@extends('cms.parent');
@section('title','course')
@section('title-sub','create course')
@section('content')
<section class="content">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">create course</h3>
        </div>
        <!-- /.card-header -->
       @include('cms.layout.error');
        <!-- form start -->
        <form action="{{route("course.update",$course->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">name</label>
              <input type="text" name="name"  class="form-control" value="{{$course->name}}" placeholder="Enter name category">
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">content</label>
              {{-- <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name category"> --}}
              <textarea cols="100" rows="5" class="form-control" name="content">{{$course->content}}</textarea>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">image</label>
              <input type="file" name="image" class="form-control" value="{{$course->image}}">
              <img width="200" class="mt-1" src="{{ asset('upload/' . $course->image) }}" alt="">
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <select name="category" class="form-control">
                <option value="{{$course->category->id}}">{{$course->category->name}}</option>  
                @foreach ($categories as $category)
                     @if ($category->id!=$course->category->id)
                  <option value="{{$category->id}}">{{$category->name}}</option>  
                         
                     @endif             
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