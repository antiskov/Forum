@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Adding Topic</h3>
    @if (Route::has('login'))
    	@auth
    	<form action="{{ route('add-topic') }}" method="post">
    		@csrf
    		<div class="form-group">
    		<input class="form-control" type="text" placeholder="What you intersting?" name="topic">
  		</div>
    		<button type='submit' class="btn btn-success">Add topic</button>
    	</form>    	
      @endauth
    @endif
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection