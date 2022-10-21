@extends('cms.parent');
@section('content')
<section class="content">
    @if (session("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
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
            <th>created_at</th>
            <th>updated_at</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td><a href="{{route("CategoryToCourse",$category->slug)}}" class="btn btn-primary">courses({{$category->courses_count}})</a></td>
                <td>{{$category->created_at->format('d-m-Y')}}</td>
                <td>{{$category->updated_at->format('d-m-Y')}}</td>
                <td>
                    <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                  <form class="d-inline" action="{{route('category.destroy',$category->id)}}" method="POST">
                    @csrf
                    @method("delete")
                    <button onclick="return confirm('sure deleted category')" class="btn btn-danger" type="submit"><i class="fas fa-times"></i></button>
                </form>
                </td>
              </tr>  
            @endforeach
        </tbody>
      </table>
      {{$categories->links()}}
    </div>
    <!-- /.card-body -->
  </div>
</section>
  @endsection