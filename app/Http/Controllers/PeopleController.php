<?php

namespace App\Http\Controllers;

use App\Repositories\PeopleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PeopleController extends Controller
{

     public function __construct(
        private PeopleRepository $peopleRepository
    ) {}

    /**
     * Display a listing of the resource.
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        try {
            $peoples = $this->peopleRepository->all();
            return view('peoples.index', compact('peoples'));
        } catch (\Exception $e) {
            return view('peoples.index')
                ->with('peoples', collect([]))
                ->with('error', 'Erro ao carregar lista de pessoas: ' . $e->getMessage());
        }
    }

    /**
    * Show the form for creating a new resource.
    * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        return view('peoples.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try{
            $this->peopleRepository->create($request->all());

            return to_route('peoples.index')
                ->with('success', 'Pessoa cadastrada com sucesso.');
        } catch (\Exception $e) {
            return back()
            ->withInput()
            ->with('error', 'Erro ao cadastrar pessoa: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\View\View
     */
    public function edit(string $id): \Illuminate\View\View
    {
        return view('peoples.edit')->with('people', $this->peopleRepository->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
