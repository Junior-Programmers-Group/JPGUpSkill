@extends('layouts.app')

@section('title', 'Notes')

@section('content')
    <div class="card">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <h1 style="margin:0;">Notes</h1>
            <a class="btn" href="{{ route('notes.create') }}">New note</a>
        </div>
    </div>

    @if ($notes->isEmpty())
        <div class="card">
            <p style="margin:0;">No notes yet. <a href="{{ route('notes.create') }}">Create the first one</a>.</p>
        </div>
    @else
        <table>
            <thead>
            <tr>
                <th>Title</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($notes as $note)
                <tr>
                    <td><a href="{{ route('notes.show', $note) }}">{{ $note->title }}</a></td>
                    <td class="muted">{{ $note->updated_at?->format('Y-m-d H:i') }}</td>
                    <td>
                        <div class="actions">
                            <a class="btn btn-secondary" href="{{ route('notes.show', $note) }}">View</a>
                            <a class="btn btn-secondary" href="{{ route('notes.edit', $note) }}">Edit</a>
                            <form action="{{ route('notes.destroy', $note) }}" method="POST"
                                  onsubmit="return confirm('Delete this note?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
