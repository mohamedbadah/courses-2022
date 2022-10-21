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
            <th>course</th>
            <th>status</th>
            <th>created_at</th>
            <th>updated_at</th>
            {{-- <th>action</th> --}}
          </tr>
        </thead>
        <tbody>
            @foreach ($registerations as $registeration)
            <tr class="p-3">
                <td>{{$registeration->id}}</td>
                <td>{{$registeration->user->name}}</td>
                <td>{{$registeration->course->name}}</td>
                <td class="@if ($registeration->active=="completed") btn  btn-success btn-block @else btn btn-danger btn-block  @endif">{{$registeration->active}}</td>
                <td>{{$registeration->created_at->format('d-m-Y')}}</td>
                <td>{{$registeration->updated_at->format('d-m-Y')}}</td>
                <td>
                  <form class="d-inline" action="{{route('deleteRegister',$registeration->id)}}" method="POST">
                    @csrf
                    @method("delete")
                    <button onclick="return confirm('sure deleted register')" class="btn btn-danger" type="submit"><i class="fas fa-times"></i></button>
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