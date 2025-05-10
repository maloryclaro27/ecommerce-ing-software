@extends('layouts.app')

@section('title', 'Historial de Pedidos')

@section('content')
<div class="max-w-4xl mx-auto mt-24 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Historial de Pedidos</h2>

    @if($pedidos->isEmpty())
        <p>No has realizado ningún pedido aún.</p>
    @else
        <table class="w-full table-auto border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border"># Pedido</th>
                    <th class="px-4 py-2 border">Fecha</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                <tr>
                    <td class="px-4 py-2 border">{{ $pedido->id }}</td>
                    <td class="px-4 py-2 border">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2 border">${{ number_format($pedido->total, 2, ',', '.') }}</td>
                    <td class="px-4 py-2 border">{{ ucfirst($pedido->estado ?? 'pendiente') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
