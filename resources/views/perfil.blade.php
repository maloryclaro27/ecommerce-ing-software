@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Encabezado con imagen de perfil -->
        <div class="flex items-center mb-8">
            <div class="relative">
                @if ($user->foto_perfil)
                    <img src="{{ asset('storage/' . $user->foto_perfil) }}"
                         class="w-20 h-20 rounded-full object-cover" alt="Foto de perfil">
                @else
                    <div class="w-20 h-20 rounded-full bg-[#ff441f] flex items-center justify-center text-white text-2xl font-bold">
                        {{ strtoupper(substr($user->nombre, 0, 1)) }}
                    </div>
                @endif

                <label for="foto_perfil" class="absolute bottom-0 right-0 bg-white p-1 rounded-full shadow-md hover:bg-gray-100 transition cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#ff441f]" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </label>
            </div>

            <div class="ml-6">
                <h1 class="text-3xl font-bold text-gray-800">{{ $user->nombre }}</h1>
                <p class="text-gray-600">{{ $user->correo_electronico }}</p>
            </div>
        </div>

        <!-- Notificación de éxito -->
        @if(session('success'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-transition
             x-init="setTimeout(() => show = false, 3000)"
             class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Formulario de perfil -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-800 text-white px-6 py-4">
                <h2 class="text-xl font-semibold">Información Personal</h2>
            </div>
            
            <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data" class="p-6">
                @csrf

                <input type="file" name="foto_perfil" id="foto_perfil" class="hidden">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" value="{{ $user->nombre }}" disabled
                               class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100 focus:outline-none">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                        <input type="email" value="{{ $user->correo_electronico }}" disabled
                               class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" value="{{ $user->telefono }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#ff441f] focus:border-[#ff441f]">
                    </div>
                    
                    <div>
                        <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                        <input type="text" id="direccion" name="direccion" value="{{ $user->direccion }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#ff441f] focus:border-[#ff441f]">
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <a href="password.change" 
                       class="text-[#ff441f] hover:text-[#e03d1c] transition flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        Cambiar contraseña
                    </a>
                    
                    <button type="submit" 
                            class="bg-[#ff441f] text-white px-6 py-2 rounded-md hover:bg-[#e03d1c] transition duration-200 flex items-center shadow hover:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M7.707 10.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 00-1.414-1.414L11.293 13.586 7.707 10.293z" />
                        </svg>
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
