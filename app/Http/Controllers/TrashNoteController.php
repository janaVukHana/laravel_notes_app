<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class TrashNoteController extends Controller
{
    public function index() {
        $notes = Note::whereBelongsTo(auth()->user())->onlyTrashed()->latest('updated_at')->paginate(3);

        return view('notes.index', compact('notes'));
    }

    public function show(Note $note) {

        if(auth()->user()->id != $note->user_id) {
            abort(403);
        }

        return view('notes.show', compact('note'));
    }

    public function update(Note $note) {
        if(auth()->user()->id != $note->user_id) {
            abort(403);
        }

        $note->restore();

        return to_route('notes.index')->with('success', 'Note restored.');
    }

    public function destroy(Note $note) {
        if(auth()->user()->id != $note->user_id) {
            abort(403);
        }

        $note->forceDelete();

        return to_route('trashed.index')->with('success', 'Note is permanently deleted.');
    }
}
