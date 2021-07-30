<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Laravel\Jetstream\Jetstream;

class PatientController extends Controller
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
        Gate::authorize('viewAny', Patient::class);

        return Jetstream::inertia()->render($request, 'Patient/Index', [
            'patients' => Patient::with('notes')
                ->orderByName()
                ->paginate(20)
                ->withQueryString()
                ->through(fn ($patient) => [
                    'id'         => $patient->id,
                    'first_name' => $patient->first_name,
                    'known_as'   => $patient->known_as,
                    'last_name'  => $patient->last_name,
                    'title'      => $patient->title,
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
        Gate::authorize('create', Patient::class);

        return Jetstream::inertia()->render($request, 'Patient/Create');
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
        Gate::authorize('create', Patient::class);

        $request->validateWithBag('createCompany', $this->rules());

        Patient::firstOrCreate([
            'first_name' => $request['first_name'],
            'known_as'   => $request['known_as'],
            'last_name'  => $request['last_name'],
            'title'      => $request['title'],
        ]);

        return Redirect::route('patients.index', [], 303);
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
                'first_name' => 'required|string|max:50',
                'known_as'   => 'string|nullable|max:50',
                'last_name'  => 'required|string|max:50',
                'title'      => 'string|nullable|max:10',
            ];
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Patient $patient
     *
     * @return Response
     */
    public function show(Request $request, Patient $patient): Response
    {
        Gate::authorize('view', $patient);

        return Jetstream::inertia()->render($request, 'Patient/Edit', [
            'patient' => $patient,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Patient $patient
     *
     * @return Response
     */
    public function edit(Request $request, Patient $patient): Response
    {
        Gate::authorize('update', $patient);

        $patient->load('notes');

        return Jetstream::inertia()->render($request, 'Patient/Edit', [
            'patient' => $patient,
        ]);
    }

    /**
     * Update the specified resource in the database.
     *
     * @param Request $request
     * @param Patient $patient
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Patient $patient): RedirectResponse
    {
        Gate::authorize('update', $patient);

        $request->validateWithBag('updatePerson', $this->rules());

        $patient->update([
            'first_name' => $request['first_name'],
            'known_as'   => $request['known_as'],
            'last_name'  => $request['last_name'],
            'title'      => $request['title'],
        ]);

        return Redirect::route('patients.index', [], 303);
    }

    /**
     * Remove the specified resource from the database.
     *
     * @param Patient $patient
     *
     * @return RedirectResponse
     */
    public function destroy(Patient $patient): RedirectResponse
    {
        Gate::authorize('delete', $patient);

        $patient->delete();

        return Redirect::route('patients.index', [], 303);
    }

    /**
     * Restore the specified resource back from a soft deleted state
     *
     * @param Patient $patient
     *
     * @return RedirectResponse
     */
    public function restore(Patient $patient)
    {
        $patient->restore();

        return Redirect::route('patients.index', [], 303);
    }
}
