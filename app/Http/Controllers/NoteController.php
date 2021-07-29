<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Laravel\Jetstream\Jetstream;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        Gate::authorize('viewAny', Note::class);

        return Jetstream::inertia()->render($request, 'Note/Index', [
            'notes' => Note::orderBy('created_at', 'desc')
                ->paginate(20)
                ->withQueryString()
                ->through(fn ($note) => [
                    'id'    => $note->id,
                    'title' => $note->title,
                    'note'  => $note->note,
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request): Response
    {
        Gate::authorize('create', Note::class);

        return Jetstream::inertia()->render($request, 'Note/Create');
    }

    /**
     * Store a newly created resource in the database.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', Note::class);

        $request->validateWithBag('createNote', $this->rules());

        Note::firstOrCreate([
            'patient_id' => $request['patient_id'],
            'title'      => $request['title'],
            'note'       => $request['note'],
        ]);

        return back();
    }

    /**
     * Validation rules for user input.
     *
     * @return array
     */
    protected function rules()
    {
        return
            [
                'patient_id' => 'required|exists:patients,id',
                'title'      => 'required|string|max:100',
                'note'       => 'required|string|max:800',
            ];
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Note    $note
     *
     * @return Response
     */
    public function show(Request $request, Note $note): Response
    {
        Gate::authorize('view', $note);

        return Jetstream::inertia()->render($request, 'Note/Edit', [
            'note' => $note,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Note    $note
     *
     * @return Response
     */
    public function edit(Request $request, Note $note): Response
    {
        Gate::authorize('update', $note);

        return Jetstream::inertia()->render($request, 'Note/Edit', [
            'note' => $note,
        ]);
    }

    /**
     * Update the specified resource in the database.
     *
     * @param Request $request
     * @param Note    $note
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Note $note): RedirectResponse
    {
        Gate::authorize('update', $note);

        $request->validateWithBag('updateNote', $this->rules());

        $note->update([
            'title' => $request['title'],
            'note'  => $request['note'],
        ]);

        return Redirect::route('notes.index', [], 303);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Note $note
     *
     * @return RedirectResponse
     */
    public function destroy(Note $note): RedirectResponse
    {
        Gate::authorize('delete', $note);

        $note->delete();

        return Redirect::route('notes.index', [], 303);
    }

    /**
     * Restore the specified resource back from a soft deleted state
     *
     * @param Note $note
     *
     * @return RedirectResponse
     */
    public function restore(Note $note)
    {
        $note->restore();

        return Redirect::route('notes.index', [], 303);
    }
}
