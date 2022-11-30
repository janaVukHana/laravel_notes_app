@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1>{{ $note->title }}</h1>
                </div>
                <div class="d-flex">
                    <a class="btn btn-primary" href="{{ route('notes.edit', $note) }}">Edit</a>
                    <form class="ms-3" action="{{route('notes.destroy', $note)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Move to Trash</button>
                    </form>
                </div>
            </div>
            <p>{{$note->content}}</p>
        </div>
    </div>
</div>
@endsection