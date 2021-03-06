@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Adding Tred</h3>
        @if (Route::has('login'))
            @auth
                <form action="{{ route('set-thread', $topicId) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" type="text" required placeholder="What you intersting?" name="thread_item">
                    </div>
                    <button type='submit' class="btn btn-success">Add tred</button>
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
