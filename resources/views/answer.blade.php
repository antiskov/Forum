@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Adding Answer</h3>
        @if (Route::has('login'))
            @auth
                <form action="{{ route('add-answer', [$tredId, $boardId]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" type="text" required placeholder="What you intersting?" name="answer_item">
                    </div>
                    <button type='submit' class="btn btn-success">Add qoute</button>
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