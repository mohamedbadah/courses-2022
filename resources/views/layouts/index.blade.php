@extends('layouts.master')
@section('content')
<main>
  <section class="hero">
    <div class="content">
      <h1 class="mb-4 mt-0">We are the top one in the Market</h1>
      <form action="{{route('search')}}" method="POST">
        @csrf
        <input type="text" name="s" placeholder="Course name.." class="form-control form-control-lg">
        <button class="btn btn-block btn-dark mt-4 form-control form-control-lg">search</button>
      </form>
    </div>
  </section>

  <section class="courses py-5">
    <div class="container">
      <h2 class="text-center mb-4">Our Courses</h2>
      <div class="row justify-content-center">
        @foreach ($courses as $course)
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card">
            <img src="{{asset('upload/'.$course->image)}}" class="card-img-top" alt="...">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{$course->name}}</h5>
                <h5>{{$course->price}}$</h5>
              </div>
              <p class="card-text">
                @php
                    echo substr($course->content,0,100)
                @endphp
              </p>
              <a href="{{route('course',$course->slug)}}" class="btn btn-dark w-100">Go somewhere</a>
            </div>
          </div>
        </div>
        @endforeach
       
      </div>
    </div>
  </section>
</main>
@endsection