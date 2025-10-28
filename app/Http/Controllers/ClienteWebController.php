<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ClienteWebController extends Controller
{
    public function index(): View
    {
        $clientes = Cliente::orderBy('cliente')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function create(): View
    {
        return view('clientes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:150',
            'direccion' => 'required|string|max:200'
        ]);

        Cliente::create($request->only(['nombre_cliente', 'direccion']));

        return redirect('/admin/clientes')
            ->with('success', 'Cliente creado exitosamente');
    }

    public function show(Cliente $cliente): View
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente): View
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente): RedirectResponse
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:150',
            'direccion' => 'required|string|max:200'
        ]);

        $cliente->update($request->only(['nombre_cliente', 'direccion']));

        return redirect('/admin/clientes')
            ->with('success', 'Cliente actualizado exitosamente');
    }

    public function destroy(Cliente $cliente): RedirectResponse
    {
        $cliente->delete();

        return redirect('/admin/clientes')
            ->with('success', 'Cliente eliminado exitosamente');
    }
}
