@extends('layouts.app')

@section('title', 'Historial de Pedidos')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Encabezado -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Historial de Pedidos</h1>
            <div class="relative">
                <button id="filterDropdownButton" class="flex items-center space-x-2 bg-white border border-gray-300 rounded-lg px-4 py-2 hover:bg-gray-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#ff441f]" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                    </svg>
                    <span>Filtrar</span>
                </button>
                <div id="filterDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg z-10 border border-gray-200">
                    <div class="p-4">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Estado del pedido</h3>
                        <div class="space-y-2">
                            <label class="flex items-center"><input type="checkbox" class="form-checkbox h-4 w-4 text-[#ff441f] rounded" checked><span class="ml-2 text-sm text-gray-700">Todos</span></label>
                            <label class="flex items-center"><input type="checkbox" class="form-checkbox h-4 w-4 text-[#ff441f] rounded"><span class="ml-2 text-sm text-gray-700">Completado</span></label>
                            <label class="flex items-center"><input type="checkbox" class="form-checkbox h-4 w-4 text-[#ff441f] rounded"><span class="ml-2 text-sm text-gray-700">Pendiente</span></label>
                            <label class="flex items-center"><input type="checkbox" class="form-checkbox h-4 w-4 text-[#ff441f] rounded"><span class="ml-2 text-sm text-gray-700">Cancelado</span></label>
                        </div>
                        <div class="mt-4 pt-3 border-t border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Rango de fechas</h3>
                            <div class="grid grid-cols-2 gap-2">
                                <input type="date" class="text-sm border-gray-300 rounded focus:border-[#ff441f] focus:ring-[#ff441f]">
                                <input type="date" class="text-sm border-gray-300 rounded focus:border-[#ff441f] focus:ring-[#ff441f]">
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button class="px-3 py-1 bg-[#ff441f] text-white text-sm rounded hover:bg-[#e03d1c] transition">Aplicar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($pedidos->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="text-xl font-medium text-gray-600 mb-2">No has realizado ningún pedido aún</h3>
                <p class="text-gray-500 mb-6">Cuando hagas tu primer pedido, aparecerá aquí.</p>
                <a href="{{ route('catalogo') }}" class="inline-block bg-[#ff441f] text-white px-6 py-2 rounded-md hover:bg-[#e03d1c] transition">
                    Explorar productos
                </a>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"># Pedido</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pedidos as $pedido)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pedido->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($pedido->total, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'completado' => 'bg-green-100 text-green-800',
                                            'cancelado' => 'bg-red-100 text-red-800',
                                            'pendiente' => 'bg-yellow-100 text-yellow-800',
                                            'procesando' => 'bg-purple-100 text-purple-800'
                                        ];
                                        $estado = strtolower($pedido->estado ?? 'pendiente');
                                        $colorClass = $statusColors[$estado] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colorClass }}">
                                        {{ ucfirst($estado) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($pedidos->hasPages())
                <div class="bg-white px-6 py-3 border-t border-gray-200">
                    {{ $pedidos->links() }}
                </div>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    // Mostrar/ocultar dropdown de filtros
    document.getElementById('filterDropdownButton').addEventListener('click', function() {
        const dropdown = document.getElementById('filterDropdown');
        dropdown.classList.toggle('hidden');
    });

    // Cerrar dropdown al hacer click fuera
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('filterDropdown');
        const button = document.getElementById('filterDropdownButton');
        if (!button.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
@endpush
