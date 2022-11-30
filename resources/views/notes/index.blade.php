@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Your Notes</h1>
            <a href="{{ route('notes.create') }}" class="btn btn-primary">Add New Note</a>

            <div class="mt-3">
                @forelse ($notes as $note)
                    <div class="mb-3 p-2 bg-secondary border rounded-end text-white">
                        <h2><a class="text-decoration-none text-white" href="{{route('notes.show', $note)}}">{{ $note->title }}</a></h2>
                        <p>Note content</p>
                    </div>
                @empty
                    {{-- code here what if there is no any notes --}}
                    <div class="mb-3 p-2 bg-secondary border rounded-end text-white">
                        <h2>You don't have any notes.</h2>
                        
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection