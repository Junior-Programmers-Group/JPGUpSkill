@extends('layouts.app')

@section('title', 'New note')

@section('content')
    <h1>New note</h1>

    <div class="card">
        <form action="{{ route('notes.store') }}" method="POST">
            @csrf

            <div class="field">
                <label for="title">Title</label>
                <input id="title" type="text" name="title" value="{{ old('title') }}" required autofocus>
                @error('title')
                    <div class="errors" style="margin-top:.5rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="content">Content</label>
                <textarea id="content" name="content" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="errors" style="margin-top:.5rem;">{{ $message }}</div>
                @enderror
            </div>

            <div class="actions">
                <button class="btn" type="submit">Save note</button>
                <a class="btn btn-secondary" href="{{ route('notes.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
