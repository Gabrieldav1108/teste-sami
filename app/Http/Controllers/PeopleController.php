<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeopleRequest;
use App\Http\Requests\UpdatePeopleRequest;
use App\Repositories\PeopleRepository;
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
            return view('people.index', compact('peoples'));
        } catch (\Exception $e) {
            return view('people.index')
                ->with('people', collect([]))
                ->with('error', 'Erro ao carregar lista de pessoas: ' . $e->getMessage());
        }
    }

    /**
    * Show the form for creating a new resource.
    * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\StorePeopleRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePeopleRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();

            $data['cpf'] = preg_replace('/\D/', '', $data['cpf']);
            $data['telefone'] = preg_replace('/\D/', '', $data['telefone']);

            $this->peopleRepository->create($data);

            return to_route('people.index')
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
        return view('people.edit')->with('people', $this->peopleRepository->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\UpdatePeopleRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePeopleRequest $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validated();

            if (!empty($data)) {
                $this->peopleRepository->update($id, $data);
                
                return to_route('people.index')
                    ->with('success', 'Pessoa atualizada com sucesso.');
            } else {
                return to_route('people.index')
                    ->with('info', 'Nenhuma alteração foi realizada.');
            }

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao atualizar pessoa: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->peopleRepository->delete($id);

            return to_route('people.index')
                ->with('success', 'Pessoa excluída com sucesso.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Erro ao excluir pessoa: ' . $e->getMessage());
        }
    }
}
