@extends('layouts.app')

@section('title', $note->title)

@section('content')
    <div class="card">
        <h1 style="margin-top:0;">{{ $note->title }}</h1>
        <p class="muted">Updated {{ $note->updated_at?->format('Y-m-d H:i') }}</p>
        <p style="white-space: pre-wrap;">{{ $note->content }}</p>

        <div class="actions">
            <a class="btn" href="{{ route('notes.edit', $note) }}">Edit</a>
            <a class="btn btn-secondary" href="{{ route('notes.index') }}">Back to notes</a>
            <form action="{{ route('notes.destroy', $note) }}" method="POST"
                  onsubmit="return confirm('Delete this note?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </div>
    </div>
@endsection
