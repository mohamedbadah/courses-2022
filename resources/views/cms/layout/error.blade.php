@if ($errors->any())
<div class="mt-4 alert alert-danger">
<ul>
    @foreach ($errors->all() as $erorr)
        <li>{{$erorr}}</li>
    @endforeach
</ul>
</div>
@endif