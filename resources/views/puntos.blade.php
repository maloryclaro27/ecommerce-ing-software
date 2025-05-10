@extends('layouts.app')

@section('title', 'Puntos HD')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Encabezado -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Mis Puntos HD</h1>
                <p class="text-gray-600 mt-2">Programa de fidelización de Home Delivery</p>
            </div>
        </div>

        <!-- Tarjeta de puntos -->
        <div class="bg-gradient-to-r from-[#ff441f] to-[#ff6b3f] rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="p-6 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-xl font-semibold mb-2">Tus Puntos HD</h2>
                        <p class="opacity-90 mb-4">Disponibles para redimir</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full px-4 py-2 text-xl font-bold">
                        {{ $puntos }} PTS
                    </div>
                </div>
                
                <!-- Barra de progreso -->
                <div class="mt-6">
                    <div class="flex justify-between text-sm mb-1">
                        <span>Nivel Actual</span>
                        <span>Próximo nivel en {{ 1000 - ($puntos % 1000) }} PTS</span>
                    </div>
                    <div class="w-full bg-white bg-opacity-30 rounded-full h-2.5">
                        <div class="bg-white h-2.5 rounded-full" style="width: {{ ($puntos % 1000) / 10 }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs mt-1">
                        <span>{{ floor($puntos / 1000) * 1000 }} PTS</span>
                        <span>{{ ceil($puntos / 1000) * 1000 }} PTS</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cómo funciona -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="bg-gray-800 text-white px-6 py-4">
                <h2 class="text-xl font-semibold">¿Cómo funcionan los Puntos HD?</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="bg-[#ff441f] bg-opacity-10 text-[#ff441f] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-800 mb-1">Gana puntos</h3>
                        <p class="text-sm text-gray-600">Obtienes <strong>50 puntos por cada $1,000</strong> en tus compras</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-[#ff441f] bg-opacity-10 text-[#ff441f] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-800 mb-1">Acumula</h3>
                        <p class="text-sm text-gray-600">Tus puntos no expiran y son acumulables</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-[#ff441f] bg-opacity-10 text-[#ff441f] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-800 mb-1">Redime</h3>
                        <p class="text-sm text-gray-600">Usa tus puntos en múltiplos de 1,000 para obtener descuentos</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Beneficios -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-800 text-white px-6 py-4">
                <h2 class="text-xl font-semibold">Beneficios por niveles</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Nivel 1 -->
                    <div class="flex items-start">
                        <div class="bg-[#ff441f] text-white rounded-full w-8 h-8 flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                            1
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800">Nivel Plata (1,000+ PTS)</h3>
                            <ul class="list-disc pl-5 text-sm text-gray-600 mt-1 space-y-1">
                                <li>5% de descuento en tu cumpleaños</li>
                                <li>Prioridad en soporte al cliente</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Nivel 2 -->
                    <div class="flex items-start">
                        <div class="bg-[#ff441f] text-white rounded-full w-8 h-8 flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                            2
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800">Nivel Oro (5,000+ PTS)</h3>
                            <ul class="list-disc pl-5 text-sm text-gray-600 mt-1 space-y-1">
                                <li>10% de descuento en tu cumpleaños</li>
                                <li>Envíos gratuitos en compras mayores a $50,000</li>
                                <li>Acceso a ofertas exclusivas</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Nivel 3 -->
                    <div class="flex items-start">
                        <div class="bg-[#ff441f] text-white rounded-full w-8 h-8 flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                            3
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800">Nivel Platino (10,000+ PTS)</h3>
                            <ul class="list-disc pl-5 text-sm text-gray-600 mt-1 space-y-1">
                                <li>15% de descuento en tu cumpleaños</li>
                                <li>Envíos gratuitos en todas tus compras</li>
                                <li>Acceso prioritario a nuevos productos</li>
                                <li>Asistente personal de compras</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- CTA -->
                <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                    <p class="text-gray-600 mb-4">¿Listo para usar tus puntos?</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Animación para la barra de progreso
    document.addEventListener('DOMContentLoaded', function() {
        const progressBar = document.querySelector('.bg-white.h-2.5');
        progressBar.style.transition = 'width 1s ease-in-out';
        progressBar.style.width = '0';
        setTimeout(() => {
            progressBar.style.width = '{{ ($puntos % 1000) / 10 }}%';
        }, 100);
    });
</script>
@endpush