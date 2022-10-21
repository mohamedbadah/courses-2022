@extends('cms.parent');
@section('content')
<section class="content">
    @if (session("success"))
    <div class="alert alert-success" role="alert">
        <strong>category </strong> {{session("success")}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
    @endif
    
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Responsive Hover Table</h3>

      <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
          <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

          <div class="input-group-append">
            <button type="submit" class="btn btn-default">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>name</th>
            <th>content</th>
            <th>image</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($category->courses as $category_course)
            <tr>
                <td>{{$category_course->id}}</td>
                <td>{{$category_course->name}}</td>
                <td>{{substr($category_course->content,1,10)}}</td>
                <td>
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{asset("upload/$category_course->image")}}" alt="User profile picture">
                  </div>
                </td>
                <td>{{$category_course->created_at->format('d-m-Y')}}</td>
                <td>{{$category_course->updated_at->format('d-m-Y')}}</td>
                <td>
                    <a href="{{route('course.edit',$category_course->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                  <form class="d-inline" action="{{route('course.destroy',$category_course->id)}}" method="POST">
                    @csrf
                    @method("delete")
                    <button onclick="return confirm('sure deleted category')" class="btn btn-danger" type="submit"><i class="fas fa-times"></i></button>
                </form>
                </td>
              </tr>  
            @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
</section>
  @endsection