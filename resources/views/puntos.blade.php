@extends('layouts.app')

@section('title', 'Puntos HD')

@section('content')
<div class="max-w-3xl mx-auto mt-24 p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Puntos HD</h2>

    <p class="mb-4">
        Por cada <strong>$10.000</strong> en compras, acumulas <strong>1 punto HD</strong>. Estos puntos podrás redimirlos más adelante en beneficios exclusivos para clientes frecuentes.
    </p>

    <div class="bg-blue-100 text-blue-800 px-4 py-3 rounded text-lg">
        <strong>Puntos acumulados:</strong> {{ $puntos }}
    </div>
</div>
@endsection
