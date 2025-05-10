@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="bg-[#ff441f] text-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="p-8 md:p-12 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Soporte al Cliente</h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto">Estamos aquí para ayudarte en cada paso de tu experiencia con Home Delivery</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-800 text-white px-6 py-4">
                <h2 class="text-xl font-semibold">Información de Contacto</h2>
            </div>
            <div class="p-6">
                <div class="flex items-start mb-6">
                    <div class="bg-[#ff441f] text-white p-3 rounded-full mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800 mb-1">Teléfono de Soporte</h3>
                        <p class="text-gray-600">+7 315 445 3445</p>
                        <p class="text-sm text-gray-500 mt-1">Lunes a Domingo, 7am - 10pm</p>
                    </div>
                </div>

                <div class="flex items-start mb-6">
                    <div class="bg-[#ff441f] text-white p-3 rounded-full mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800 mb-1">Correo Electrónico</h3>
                        <p class="text-gray-600">info@homedelivery.com</p>
                        <p class="text-sm text-gray-500 mt-1">Respuesta en menos de 24 horas</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-[#ff441f] text-white p-3 rounded-full mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800 mb-1">Oficina Principal</h3>
                        <p class="text-gray-600">Av. El Jardín #46, Bucaramanga</p>
                        <p class="text-sm text-gray-500 mt-1">Horario de atención: 8am - 6pm</p>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="font-medium text-gray-800 mb-3">Soporte en Redes Sociales</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-[#ff441f] transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-[#ff441f] transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-[#ff441f] transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden lg:col-span-2">
            <div class="bg-gray-800 text-white px-6 py-4">
                <h2 class="text-xl font-semibold">Preguntas Frecuentes</h2>
            </div>
            <div class="p-6">
                <div x-data="{ activeFaq: null }" class="space-y-4">
                    <!-- FAQ Item 1 -->
                    <div x-data="{ isOpen: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="isOpen = !isOpen" class="w-full flex justify-between items-center p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                            <span class="font-medium text-gray-800">¿Qué es Home Delivery y cómo funciona?</span>
                            <svg :class="{ 'rotate-180': isOpen }" class="h-5 w-5 text-[#ff441f] transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="isOpen" x-collapse class="p-4 text-gray-600">
                            <p>Home Delivery es un servicio innovador de entrega a domicilio que utiliza drones, motos y bicicletas para llevar tus productos favoritos de negocios asociados directamente a tu puerta. Funciona en 3 simples pasos:</p>
                            <ol class="list-decimal pl-5 mt-2 space-y-1">
                                <li>Explora nuestro catálogo de productos de negocios asociados</li>
                                <li>Selecciona tus productos y completa el formulario de envío</li>
                                <li>Realiza el pago y sigue tu pedido en tiempo real hasta la entrega</li>
                            </ol>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div x-data="{ isOpen: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="isOpen = !isOpen" class="w-full flex justify-between items-center p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                            <span class="font-medium text-gray-800">¿Cuáles son los métodos de pago aceptados?</span>
                            <svg :class="{ 'rotate-180': isOpen }" class="h-5 w-5 text-[#ff441f] transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="isOpen" x-collapse class="p-4 text-gray-600">
                            <p>Aceptamos los siguientes métodos de pago:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Tarjetas de crédito/débito (Visa, MasterCard, American Express)</li>
                                <li>Transferencias bancarias</li>
                                <li>Pago contra entrega (efectivo)</li>
                                <li>Puntos HD (nuestro programa de fidelización)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div x-data="{ isOpen: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="isOpen = !isOpen" class="w-full flex justify-between items-center p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                            <span class="font-medium text-gray-800">¿Cómo funciona el programa de puntos HD?</span>
                            <svg :class="{ 'rotate-180': isOpen }" class="h-5 w-5 text-[#ff441f] transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="isOpen" x-collapse class="p-4 text-gray-600">
                            <p>Nuestro programa de fidelización te recompensa por cada compra:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Ganas <strong>50 puntos por cada $1,000 pesos</strong> en tus compras</li>
                                <li>1 punto equivale a 1 peso al momento de pagar</li>
                                <li>Puedes usar tus puntos en múltiplos de 1,000 (ej: 1,000, 2,000, etc.)</li>
                                <li>Los puntos no expiran y son acumulables</li>
                            </ul>
                            <p class="mt-2">Ejemplo: Si gastas $20,000 pesos, ganas 1,000 puntos HD que equivalen a $1,000 pesos de descuento en tu próxima compra.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div x-data="{ isOpen: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="isOpen = !isOpen" class="w-full flex justify-between items-center p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                            <span class="font-medium text-gray-800">¿Cuáles son los límites para envíos con drones?</span>
                            <svg :class="{ 'rotate-180': isOpen }" class="h-5 w-5 text-[#ff441f] transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="isOpen" x-collapse class="p-4 text-gray-600">
                            <p>Los drones tienen ciertas limitaciones para garantizar la seguridad:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li><strong>Peso máximo:</strong> 2.5 kg por pedido</li>
                                <li><strong>Tamaño máximo:</strong> 30cm x 30cm x 30cm</li>
                                <li><strong>Distancia máxima:</strong> 8 km desde el negocio</li>
                                <li><strong>Horario:</strong> 8am a 6pm (dependiendo de condiciones climáticas)</li>
                            </ul>
                            <p class="mt-2">Si tu pedido excede estos límites, nuestro sistema automáticamente asignará una moto o bicicleta para la entrega.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div x-data="{ isOpen: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="isOpen = !isOpen" class="w-full flex justify-between items-center p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                            <span class="font-medium text-gray-800">¿Cómo puedo rastrear mi pedido?</span>
                            <svg :class="{ 'rotate-180': isOpen }" class="h-5 w-5 text-[#ff441f] transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="isOpen" x-collapse class="p-4 text-gray-600">
                            <p>Puedes rastrear tu pedido en tiempo real de varias formas:</p>
                            <ol class="list-decimal pl-5 mt-2 space-y-1">
                                <li>Accede a la sección "Monitoreo de Pedidos" en tu cuenta</li>
                                <li>Si es un envío por dron, verás la ubicación en tiempo real en el mapa</li>
                                <li>Para entregas por moto/bicicleta, verás el nombre del repartidor y su número de contacto</li>
                                <li>Recibirás notificaciones por correo o SMS en cada cambio de estado</li>
                            </ol>
                        </div>
                    </div>

                    <!-- FAQ Item 6 -->
                    <div x-data="{ isOpen: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="isOpen = !isOpen" class="w-full flex justify-between items-center p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                            <span class="font-medium text-gray-800">¿Qué hago si tengo un problema con mi pedido?</span>
                            <svg :class="{ 'rotate-180': isOpen }" class="h-5 w-5 text-[#ff441f] transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="isOpen" x-collapse class="p-4 text-gray-600">
                            <p>Si experimentas cualquier problema con tu pedido:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Para problemas con la entrega, contacta inmediatamente al repartidor (el número aparece en la app)</li>
                                <li>Para problemas con los productos recibidos, contacta al negocio directamente a través de la app</li>
                                <li>Si no se resuelve el problema, comunícate con nuestro soporte al cliente por teléfono, correo o chat</li>
                                <li>Ten a mano tu número de pedido para agilizar el proceso</li>
                            </ul>
                            <p class="mt-2">Nuestro equipo resolverá tu inconveniente en menos de 24 horas.</p>
                        </div>
                    </div>
                </div>

                <!-- Additional Help -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="font-medium text-gray-800 mb-3">¿No encontraste tu respuesta?</h3>
                    <p class="text-gray-600 mb-4">Estamos aquí para ayudarte. Contáctanos directamente y resolveremos tus dudas.</p>
                    <a href="#" class="inline-flex items-center bg-[#ff441f] text-white px-4 py-2 rounded-md hover:bg-[#e03d1c] transition">
                        Contactar Soporte
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush