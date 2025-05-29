{{-- resources/views/checkout.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Encabezado con progreso -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Finalizar Compra</h1>
            <div class="flex items-center justify-between">
                <!-- Paso 1: Carrito -->
                <div class="flex items-center text-[#ff441f]">
                    <span class="flex items-center justify-center w-8 h-8 bg-[#ff441f] rounded-full text-white mr-2">1</span>
                    <span>Carrito</span>
                </div>
                <div class="flex-1 h-1 bg-[#ff441f] mx-2"></div>
                <!-- Paso 2: Datos de Envío -->
                <div class="flex items-center text-[#ff441f] font-medium">
                    <span class="flex items-center justify-center w-8 h-8 bg-[#ff441f] rounded-full text-white mr-2">2</span>
                    <span>Datos de Envío</span>
                </div>
                <div class="flex-1 h-1 bg-gray-200 mx-2"></div>
                <!-- Paso 3: Pago -->
                <div class="flex items-center text-gray-400">
                    <span class="flex items-center justify-center w-8 h-8 bg-gray-200 rounded-full mr-2">3</span>
                    <span>Pago</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <form action="{{ route('checkout.process', $order->id) }}" method="POST" class="p-6">
                @csrf

                <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-[#ff441f]">Información de Contacto</h2>

                <!-- Datos del usuario -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                        <div class="bg-gray-50 p-3 rounded-md border border-gray-200 text-gray-600">
                            {{ $user->nombre }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                        <div class="bg-gray-50 p-3 rounded-md border border-gray-200 text-gray-600">
                            {{ $user->correo_electronico }}
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">N° de identificación</label>
                        <div class="bg-gray-50 p-3 rounded-md border border-gray-200 text-gray-600">
                            {{ $user->identificacion }}
                        </div>
                    </div>
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono de contacto*</label>
                        <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#ff441f] focus:border-[#ff441f]">
                        @error('telefono')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Dirección -->
                <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-[#ff441f]">Dirección de Envío</h2>
                <div class="mb-6">
                    <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección completa*</label>
                    <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#ff441f] focus:border-[#ff441f]">
                    @error('direccion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Método de pago -->
                <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-[#ff441f]">Método de Pago</h2>
                <div class="mb-8">
                    <select name="payment_method" id="payment_method" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#ff441f] focus:border-[#ff441f]">
                        <option value="">-- Selecciona un método de pago --</option>
                        <option value="tarjeta" {{ old('payment_method') == 'tarjeta' ? 'selected' : '' }}>Tarjeta crédito/débito</option>
                        <option value="transferencia" {{ old('payment_method') == 'transferencia' ? 'selected' : '' }}>Transferencia bancaria</option>
                        <option value="contraentrega" {{ old('payment_method') == 'contraentrega' ? 'selected' : '' }}>Pago contra entrega</option>
                    </select>
                    @error('payment_method')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Canjear puntos -->
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-[#ff441f]">
                  Puntos de Fidelización (1 punto = $1)
                </h2>
                <div class="mb-6">
                  <p class="mb-2">Tienes disponibles <strong>{{ auth()->user()->loyalty_points }}</strong> puntos.</p>
                  <label for="use_points" class="block mb-1">¿Cuántos puntos quieres usar?</label>
                  @php
                    $maxCanje = min(
                      intdiv(auth()->user()->loyalty_points, 1000) * 1000,
                      intdiv(($order->total - $order->shipping_cost), 1000) * 1000
                    );
                  @endphp
                  <select name="use_points" id="use_points" class="w-full px-3 py-2 border rounded mb-2">
                    <option value="0">0 (no usar puntos)</option>
                    @for($pts = 1000; $pts <= $maxCanje; $pts += 1000)
                      <option value="{{ $pts }}" {{ old('use_points') == $pts ? 'selected' : '' }}>
                        {{ $pts }} puntos (ahorras ${{ number_format($pts,0,',','.') }})
                      </option>
                    @endfor
                  </select>
                  @error('use_points')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Ocultos para controlador -->
                <input type="hidden" name="subtotal" value="{{ $order->total - $order->shipping_cost }}">
                <input type="hidden" name="shipping_cost" value="{{ $order->shipping_cost }}">
                <input type="hidden" name="establecimiento_id"
                       value="{{ $order->establecimiento_id }}">
                <input type="hidden" name="establecimiento_tipo"
                       value="{{ $order->establecimiento_tipo }}">
                <input type="hidden" name="entrega_lat"
                       value="{{ optional($order->shippingDetail)->lat }}">
                <input type="hidden" name="entrega_lng"
                       value="{{ optional($order->shippingDetail)->lng }}">

                <!-- Resumen -->
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-[#ff441f]">Resumen de Compra</h2>
                <div class="bg-gray-50 p-4 rounded-md mb-6">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Subtotal:</span>
                        <span class="font-medium">${{ number_format($order->total - $order->shipping_cost, 2, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Envío (10%):</span>
                        <span class="font-medium">${{ number_format($order->shipping_cost, 2, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-200">
                        <span class="text-gray-800">Total antes de puntos:</span>
                        <span>${{ number_format($order->total, 2, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Botón de pago -->
                <button type="submit"
                        class="w-full bg-[#ff441f] text-white py-3 px-4 rounded-md hover:bg-[#e03d1c] transition duration-200 flex items-center justify-center">
                    Realizar pago
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    select:focus, input:focus {
        transition: all 0.2s ease;
        box-shadow: 0 0 0 3px rgba(255, 68, 31, 0.2);
    }
    button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(255, 68, 31, 0.3), 0 2px 4px -1px rgba(255, 68, 31, 0.08);
    }
</style>
@endpush
