<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    CentroCusto,
    Lancamento,

};


class CentroCustoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centroCustos = CentroCusto::orderBy('centro_custo')
            ->paginate(10);
        return view('centro.index')
            ->with(compact('centroCustos'));
    }


    public function create()
    {
        $centro =null;
        return view('centro.form')
        ->with(compact('centro'));

    }

    public function store(Request $request)
    {
         CentroCusto::create($request->all());
         return redirect()
         ->route('centro.index')
        ->with('novo','Centro de custo cadastrado com sucesso!');
    }

    public function show(int $id)
    {
        $centro = CentroCusto::with([
            'lancamentos',
            'lancamentos.tipo',
            'lancamentos.usuaario',
        ])
            ->find($id)
            ->paginate(10);

            return view('centro.show')
            ->with(compact('centro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CentroCusto $centroCusto)
    {
        $centro = CentroCusto::find($id);
        return view('centro.form')
            ->with(compact('centro'));

    }

    public function update(Request $request, int $id)
    {
        $centro = CentroCusto::find($id);
        $centro->update($request->all());
        return redirect()
               ->route('centro.index')
               ->with('atualizar','Atualizado com sucesso!');
    }

    public function destroy(CentroCusto $centroCusto)
    {
        CentroCusto::find($id)->delete();
        return redirect()
        ->back()
        ->with('excluido', 'Excluido com sucesso!');
    }
}
