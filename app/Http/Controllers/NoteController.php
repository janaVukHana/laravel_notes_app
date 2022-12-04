<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // THREE WAYS WITH GET AND PAGINATE
        // $notes = Note::where('user_id', auth()->user()->id)->latest('updated_at')->get();
        // $notes = auth()->user()->notes()->latest('updated_at')->get();
        $notes = Note::whereBelongsTo(auth()->user())->latest('updated_at')->paginate(3);

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|min:6',
            'content' => 'required'
        ]);

        $formFields['user_id'] = auth()->user()->id;
        $formFields['uuid'] = Str::uuid();

        Note::create($formFields);

        return to_route('notes.index')->with('success', 'New note added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {

        // probably can use Policy here...
        if(auth()->user()->id != $note->user_id) {
            abort(403);
        }

        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        if(auth()->user()->id != $note->user_id) {
            abort(403);
        }

        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        if(auth()->user()->id != $note->user_id) {
            abort(403);
        }

        $formFields = $request->validate([
            'title' => 'required|min:6',
            'content' => 'required'
        ]);

        $note->update($formFields);

        return to_route('notes.index')->with('success', 'Note updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        if(auth()->user()->id != $note->user_id) {
            abort(403);
        }

        $note->delete();

        return to_route('notes.index')->with('success', 'Note deleted.');
    }
}
