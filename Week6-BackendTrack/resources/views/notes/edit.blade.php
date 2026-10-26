@extends('layouts.app')

@section('title', 'Edit note')

@section('content')
    <h1>Edit note</h1>

    <div class="card">
        <form action="{{ route('notes.update', $note) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="title">Title</label>
                <input id="title" type="text" name="title" value="{{ old('title', $note->title) }}" required autofocus>
                @error('title')
                    <div class="errors" style="margin-top:.5rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="content">Content</label>
                <textarea id="content" name="content" required>{{ old('content', $note->content) }}</textarea>
                @error('content')
                    <div class="errors" style="margin-top:.5rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="actions">
                <button class="btn" type="submit">Update note</button>
                <a class="btn btn-secondary" href="{{ route('notes.show', $note) }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
