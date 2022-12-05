@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center p-4 bg-white border rounded-end text-dark">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-5">

                <h1>{{ $note->title }}</h1>

                <div class="d-flex">
                    @if (request()->routeIs('notes.show'))
                        <a class="btn btn-primary" href="{{ route('notes.edit', $note) }}">
                            <i class="fa-solid fa-pen"></i> Edit
                        </a>
                        <form class="ms-3" action="{{route('notes.destroy', $note)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i> Move to Trash
                            </button>
                        </form>
                    @else
                        <form class="ms-3" action="{{route('trashed.update', $note)}}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary">Restore</button>
                        </form>
                        <form class="ms-3" action="{{route('trashed.destroy', $note)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i> Delete 4ever
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            <p>{{$note->content}}</p>
        </div>
    </div>
</div>
@endsection