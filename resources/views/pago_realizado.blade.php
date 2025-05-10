@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-6 bg-white rounded shadow text-center">
  <h1 class="text-2xl font-bold mb-4">¡Pago realizado con éxito!</h1>

  <p class="mb-2">Pedido #{{ $order->id }} registrado.</p>
  <p>Subtotal: ${{ number_format($order->total - $order->shipping_cost, 2, ',', '.') }}</p>
  <p>Envío: ${{ number_format($order->shipping_cost, 2, ',', '.') }}</p>
  <p class="font-semibold">Total pagado: ${{ number_format($order->total, 2, ',', '.') }}</p>

  <p class="mt-4">Enviado a: <strong>{{ $order->shippingDetail->direccion }}</strong></p>
  <a href="{{ route('restaurantes.index') }}"
     class="inline-block mt-6 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
    Volver al catálogo
  </a>
</div>
@endsection
