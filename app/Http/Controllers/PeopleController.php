<?php

namespace App\Http\Controllers;

use App\Repositories\PeopleRepository;
use Illuminate\Http\Request;

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
     */
    public function store(Request $request)
    {
        //
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
     */
    public function edit(string $id)
    {
        //
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
