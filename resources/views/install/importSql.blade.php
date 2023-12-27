@extends('install.app')
@section('content')
@if($message = Session::get('success'))

  <div class="card-body">
      <h3 class="text-lg-center p-3">
          @translate(Import Database)</h3>
      <p>
          @translate(By clicking this, database installation will be done without any demo data)</p>
      <a href="{{route('org.create')}}" class="btn btn-block btn-success">
          @translate(Import Database)</a>
  </div>

  <hr>

  <div class="card-body">
      <h3 class="text-lg-center p-3">
          @translate(Import Demo Sql)</h3>
      <p>
          @translate(By clicking this, database installation will be done with  demo data.)</p>
      <a href="{{route('sql.demo.setup')}}" class="btn btn-block btn-outline-success">
          @translate(Import Demo Sql)</a>
  </div>
  @endif

@if($message = Session::get('wrong'))

  <div class="card-body">
      <p>
          @translate(Check the Database connection)</p>
      <a href="{{route('create')}}" class="btn btn-block btn-danger">
          @translate(Go to the Database Setup)</a>
  </div>

@endif
@endsection
