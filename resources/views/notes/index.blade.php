@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (request()->routeIs('notes.index'))
                <h1>Your Notes</h1>  
            @else
                <h1>Trash</h1>
            @endif

            @if (request()->routeIs('notes.index'))
                <a href="{{ route('notes.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Add New Note
                </a>
            @endif

            <div class="mt-3">
                @forelse ($notes as $note)
                    <div class="mb-3 p-2 bg-white border rounded-end text-dark">
                        <div class="d-flex text-muted">
                            @if (request()->routeIs('notes.index'))
                                <p class="me-3">Created: {{ $note->created_at->diffForHumans() }}</p>
                                <p>Updated: {{ $note->updated_at->diffForHumans() }}</p>   
                            @else
                                <p>Deleted: {{ $note->deleted_at->diffForHumans() }}</p>   
                            @endif
                        </div>
                        <h2>
                            <a 
                                class="text-decoration-none text-dark" 
                                @if(request()->routeIs('notes.index'))
                                    href="{{route('notes.show', $note)}}"
                                @else
                                    href="{{route('trashed.show', $note)}}"
                                @endif
                            >
                                {{ $note->title }}
                            </a>
                        </h2>
                        <p>{{ Str::limit($note->content, 150) }}</p>
                    </div>
                @empty
                    {{-- code here what if there is no any notes --}}
                    <div class="mb-3 p-2 border rounded-end text-dark">
                        @if (request()->routeIs('notes.index'))
                            <h2>You don't have any notes.</h2>
                        @else
                            <h2>No items in trash.</h2>
                        @endif
                    </div>
                @endforelse
            </div>
            {{-- pagination with Laravel --}}
            <div class="d-flex justify-content-center">
                {!! $notes->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection