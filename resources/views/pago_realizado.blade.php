@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Encabezado con icono -->
        <div class="bg-[#ff441f] text-white p-6 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h1 class="text-3xl font-bold">¡Pago realizado con éxito!</h1>
            <p class="mt-2 opacity-90">Pedido #{{ $order->id }} registrado correctamente</p>
        </div>

        <div class="p-6">
            <!-- Desglose de montos -->
            <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                <h2 class="text-lg font-semibold text-gray-800 mb-3 pb-2 border-b border-[#ff441f]">Resumen de compra</h2>
                
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal:</span>
                        <span>${{ number_format(($order->total - $order->shipping_cost) + session('loyalty_used', 0), 2, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Envío:</span>
                        <span>${{ number_format($order->shipping_cost, 2, ',', '.') }}</span>
                    </div>
                    
                    @if(session('loyalty_used', 0) > 0)
                    <div class="flex justify-between text-green-600">
                        <span class="text-gray-600">Puntos usados:</span>
                        <span>{{ session('loyalty_used') }} &rarr; -${{ number_format(session('loyalty_used'), 2, ',', '.') }}</span>
                    </div>
                    @endif
                    
                    <div class="flex justify-between pt-2 mt-2 border-t border-gray-200 font-bold">
                        <span class="text-gray-800">Total pagado:</span>
                        <span class="text-[#ff441f]">${{ number_format($order->total, 2, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Puntos de fidelización -->
            <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                <h2 class="text-lg font-semibold text-gray-800 mb-3 pb-2 border-b border-[#ff441f]">Programa de fidelidad</h2>
                
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Puntos ganados:</span>
                        <span class="font-medium text-[#ff441f]">+{{ session('loyalty_earned', 0) }}</span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-gray-600">Saldo de puntos:</span>
                        <span class="font-medium">{{ auth()->user()->loyalty_points }}</span>
                    </div>
                </div>
            </div>

            <!-- Dirección de envío -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <h2 class="text-lg font-semibold text-gray-800 mb-2 pb-2 border-b border-[#ff441f]">Dirección de envío</h2>
                <p class="text-gray-700">{{ $order->shippingDetail->direccion }}</p>
            </div>

            <!-- Botón de acción -->
            <div class="text-center mt-8">
                <a href="{{ route('pedidos.transporte.seleccionar', $order->id) }}" 
                   class="inline-flex items-center bg-[#ff441f] text-white px-6 py-3 rounded-md hover:bg-[#e03d1c] transition duration-200 shadow hover:shadow-md">
                    Seleccionar medio de transporte
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>            
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Efectos adicionales */
    a:hover {
        transform: translateY(-1px);
    }
    .border-b {
        border-bottom-width: 2px;
    }
</style>
@endpush