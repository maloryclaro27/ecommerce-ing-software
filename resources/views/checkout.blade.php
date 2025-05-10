@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
  <h1 class="text-2xl font-bold mb-4">Datos de Envío y Pago</h1>

  <form action="{{ route('checkout.process', $order->id) }}" method="POST">
    @csrf

    {{-- Nombre --}}
    <label class="block mb-2">Nombre completo</label>
    <input type="text" 
           value="{{ $user->nombre }}" 
           disabled 
           class="w-full border px-3 py-2 mb-4 rounded" />

    {{-- Correo --}}
    <label class="block mb-2">Correo electrónico</label>
    <input type="email" 
           value="{{ $user->correo_electronico }}" 
           disabled 
           class="w-full border px-3 py-2 mb-4 rounded" />

    {{-- Identificación --}}
    <label class="block mb-2">N° de identificación</label>
    <input type="text" 
           value="{{ $user->identificacion }}" 
           disabled 
           class="w-full border px-3 py-2 mb-4 rounded" />

    {{-- Dirección --}}
    <label class="block mb-2">Dirección de entrega</label>
    <input type="text" 
           name="direccion" 
           value="{{ old('direccion') }}" 
           required 
           class="w-full border px-3 py-2 mb-4 rounded" />

    {{-- Teléfono --}}
    <label class="block mb-2">Teléfono de contacto</label>
    <input type="text" 
           name="telefono" 
           value="{{ old('telefono') }}" 
           required 
           class="w-full border px-3 py-2 mb-4 rounded" />

    {{-- Método de pago --}}
    <label class="block mb-2">Método de pago</label>
    <select name="payment_method" required
            class="w-full border px-3 py-2 mb-6 rounded">
      <option value="">-- Selecciona uno --</option>
      <option value="tarjeta">Tarjeta crédito/débito</option>
      <option value="transferencia">Transferencia bancaria</option>
      <option value="contraentrega">Pago contra entrega</option>
    </select>

    <button type="submit"
            class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
      Realizar pago
    </button>
  </form>
</div>
@endsection
