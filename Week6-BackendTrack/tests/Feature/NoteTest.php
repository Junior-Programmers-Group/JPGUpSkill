<?php

namespace Tests\Feature;

use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_root_redirects_to_notes(): void
    {
        $this->get('/')->assertRedirect('/notes');
    }

    public function test_index_lists_notes(): void
    {
        Note::create(['title' => 'Shopping list', 'content' => 'Milk, eggs']);

        $this->get('/notes')
            ->assertStatus(200)
            ->assertSee('Shopping list');
    }

    public function test_create_form_is_displayed(): void
    {
        $this->get('/notes/create')
            ->assertStatus(200)
            ->assertSee('New note');
    }

    public function test_note_can_be_created(): void
    {
        $this->post('/notes', [
            'title' => 'First note',
            'content' => 'Hello world',
        ])->assertRedirect('/notes');

        $this->assertDatabaseHas('notes', [
            'title' => 'First note',
            'content' => 'Hello world',
        ]);
    }

    public function test_title_is_required(): void
    {
        $this->from('/notes/create')->post('/notes', [
            'title' => '',
            'content' => 'Content without a title',
        ])->assertRedirect('/notes/create')->assertInvalid('title');

        $this->assertDatabaseCount('notes', 0);
    }

    public function test_note_is_shown(): void
    {
        $note = Note::create(['title' => 'Detail note', 'content' => 'Body text']);

        $this->get("/notes/{$note->id}")
            ->assertStatus(200)
            ->assertSee('Detail note')
            ->assertSee('Body text');
    }

    public function test_note_can_be_updated(): void
    {
        $note = Note::create(['title' => 'Old title', 'content' => 'Old content']);

        $this->put("/notes/{$note->id}", [
            'title' => 'New title',
            'content' => 'New content',
        ])->assertRedirect('/notes');

        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'title' => 'New title',
            'content' => 'New content',
        ]);
    }

    public function test_note_can_be_deleted(): void
    {
        $note = Note::create(['title' => 'Doomed', 'content' => 'x']);

        $this->delete("/notes/{$note->id}")->assertRedirect('/notes');

        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }
}
