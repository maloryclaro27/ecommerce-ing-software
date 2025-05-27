{{-- resources/views/pedidos_monitor.blade.php --}}

@extends('layouts.app')

@section('title', 'Monitoreo de pedido #' . $order->id)

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-3xl font-bold mb-6">Monitoreo de tu pedido</h1>

  {{-- Datos generales --}}
  <p class="mb-4"><strong>Pedido #</strong> {{ $order->id }}</p>
  <p class="mb-4"><strong>Estado entrega:</strong> 
     <span class="capitalize">{{ $order->estado_entrega }}</span>
  </p>

  @php
    $t = $order->transporte;
    $firstItem = $order->items->first();
    $business  = $firstItem ? $firstItem->establecimiento : null;
    $originLat = $business->lat ?? null;
    $originLng = $business->lng ?? null;
    $destLat   = $order->shippingDetail->lat ?? null;
    $destLng   = $order->shippingDetail->lng ?? null;
  @endphp

  @if($t->tipo === 'drone' && $originLat && $originLng && $destLat && $destLng)
    {{-- Mapa de geolocalización --}}
    <div id="map" style="height: 400px;" class="mb-6"></div>

    {{-- Tu producto --}}
    <h3 class="font-medium mb-2">Tu producto:</h3>
    <ul class="list-disc pl-6 mb-4">
      @foreach($order->items as $item)
        <li>{{ $item->producto->nombre }} ({{ $item->cantidad }})</li>
      @endforeach
    </ul>

  @elseif($t->tipo === 'drone')
    <p class="text-red-600">Coordenadas de negocio o cliente no disponibles para geolocalización.</p>
  @else
    {{-- Moto / Bicicleta --}}
    <h2 class="text-2xl font-semibold mb-4">
      {{ ucfirst($t->tipo) }} #{{ $t->id }}
    </h2>
    <p><strong>Domiciliario:</strong> {{ $t->nombre_domiciliario }}</p>
    <h3 class="mt-6 font-medium">Tu producto:</h3>
    <ul class="list-disc pl-6">
      @foreach($order->items as $item)
        <li>{{ $item->producto->nombre }} ({{ $item->cantidad }})</li>
      @endforeach
    </ul>
  @endif
</div>

{{-- Leaflet CSS & JS --}}
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
@if($t->tipo === 'drone' && $originLat && $originLng && $destLat && $destLng)
  // Coordenadas de origen (negocio) y destino (cliente)
  const origin = [{{ $originLat }}, {{ $originLng }}];
  const destination = [{{ $destLat }}, {{ $destLng }}];

  // Inicializar el mapa
  const map = L.map('map').setView(origin, 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  // Marcadores estáticos
  L.marker(origin).addTo(map).bindPopup('Negocio').openPopup();
  L.marker(destination).addTo(map).bindPopup('Destino');

  // Icono para el dron
  const droneIcon = L.icon({
    iconUrl: '/images/drone-icon.png',
    iconSize: [40, 40],
    iconAnchor: [20, 20],
  });

  // Marcador móvil
  let droneMarker = L.marker(origin, { icon: droneIcon })
                     .addTo(map)
                     .bindPopup('Dron');

  // Función para obtener posición vía AJAX
  async function fetchPosition() {
    try {
      const res = await fetch('{{ route("pedidos.position", $order->id) }}');
      const { lat, lng } = await res.json();
      droneMarker.setLatLng([lat, lng]);
    } catch (e) {
      console.error('Error fetching position:', e);
    }
  }

  // Polling cada 5 segundos
  fetchPosition();
  setInterval(fetchPosition, 5000);
@endif
</script>

@endsection
