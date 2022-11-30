@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>{{ $note->title }}</h1>
            <p>{{$note->content}}</p>
        </div>
    </div>
</div>
@endsection