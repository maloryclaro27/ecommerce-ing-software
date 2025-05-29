@extends('layouts.app')

@section('title', 'Monitoreo de pedido #' . $order->id)

@section('content')
<style>
    .tracking-container {
        padding: 80px 5% 60px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .tracking-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .tracking-title {
        font-size: 2.2rem;
        color: #ff441f;
        font-weight: 700;
        margin-bottom: 10px;
        position: relative;
        display: inline-block;
    }

    .tracking-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: #ff441f;
    }

    .order-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
    }

    .order-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    .info-item {
        margin-bottom: 15px;
    }

    .info-label {
        font-weight: 600;
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 1.1rem;
        color: #333;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 15px;
        border-radius: 20px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-pending {
        background-color: #fff3e0;
        color: #e65100;
    }

    .status-enroute {
        background-color: #e3f2fd;
        color: #1565c0;
    }

    .status-delivered {
        background-color: #e8f5e9;
        color: #2e7d32;
    }

    #map {
        height: 400px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin: 30px 0;
        border: 1px solid #eee;
    }

    .products-list {
        margin-top: 30px;
    }

    .product-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .product-name {
        font-weight: 500;
    }

    .product-qty {
        color: #666;
    }

    .delivery-person {
        display: flex;
        align-items: center;
        margin-top: 20px;
    }

    .delivery-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #ffd6cc;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: #ff441f;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .delivery-details {
        flex: 1;
    }

    .delivery-name {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .delivery-vehicle {
        color: #666;
        font-size: 0.9rem;
    }

    .loading-status {
        text-align: center;
        margin-top: 20px;
        color: #666;
        font-size: 0.9rem;
    }

    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 68, 31, 0.3);
        border-radius: 50%;
        border-top-color: #ff441f;
        animation: spin 1s ease-in-out infinite;
        margin-right: 8px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .pulse {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    @media (max-width: 768px) {
        .order-info {
            grid-template-columns: 1fr;
        }
        
        .tracking-title {
            font-size: 1.8rem;
        }
    }
</style>

<div class="tracking-container">
    <div class="tracking-header">
        <h1 class="tracking-title">Seguimiento de tu Pedido</h1>
        <p>Revisa el estado de tu entrega en tiempo real</p>
    </div>

    <div class="order-card">
        <div class="order-info">
            <div class="info-item">
                <div class="info-label">Número de Pedido</div>
                <div class="info-value">#{{ $order->id }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Estado</div>
                <div class="status-badge status-{{ str_replace(' ', '', $order->estado_entrega) }}">
                    {{ $order->estado_entrega }}
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-label">Método de Entrega</div>
                <div class="info-value">
                    {{ ucfirst($order->transporte->tipo) }}
                </div>
            </div>
        </div>

        @if($order->transporte->tipo === 'drone' && $originLat && $originLng && $destLat && $destLng)
            <div id="map" class="pulse"></div>
            
            <div class="products-list">
                <h3 class="info-label" style="font-size: 1.1rem; margin-bottom: 15px;">Tu pedido:</h3>
                @foreach($order->items as $item)
                <div class="product-item">
                    <span class="product-name">{{ $item->producto->nombre }}</span>
                    <span class="product-qty">{{ $item->cantidad }} unidad(es)</span>
                </div>
                @endforeach
            </div>
        @elseif($order->transporte->tipo === 'drone')
            <div class="info-item" style="text-align: center; padding: 20px; background: #fff8f6; border-radius: 10px;">
                <i class="fas fa-map-marker-alt" style="color: #ff441f; font-size: 1.5rem; margin-bottom: 10px;"></i>
                <p>Coordenadas no disponibles para geolocalización</p>
            </div>
        @else
            <div class="delivery-person">
                <div class="delivery-avatar">
                    {{ substr($order->transporte->nombre_domiciliario, 0, 1) }}
                </div>
                <div class="delivery-details">
                    <div class="delivery-name">{{ $order->transporte->nombre_domiciliario }}</div>
                    <div class="delivery-vehicle">
                        {{ ucfirst($order->transporte->tipo) }} #{{ $order->transporte->id }}
                    </div>
                </div>
            </div>
            
            <div class="products-list">
                <h3 class="info-label" style="font-size: 1.1rem; margin-bottom: 15px;">Tu pedido:</h3>
                @foreach($order->items as $item)
                <div class="product-item">
                    <span class="product-name">{{ $item->producto->nombre }}</span>
                    <span class="product-qty">{{ $item->cantidad }} unidad(es)</span>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- Leaflet CSS & JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
@if($order->transporte->tipo === 'drone' && $originLat && $originLng && $destLat && $destLng)
    // Coordenadas de origen y destino
    const origin = [{{ $originLat }}, {{ $originLng }}];
    const destination = [{{ $destLat }}, {{ $destLng }}];

    // Inicializar el mapa
    const map = L.map('map').setView(origin, 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Iconos personalizados
    const businessIcon = L.icon({
        iconUrl: '/img/hola.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
    });
    
    const homeIcon = L.icon({
        iconUrl: '/img/casaaa.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
    });

    const droneIcon = L.icon({
        iconUrl: '/img/5600135.png',
        iconSize: [40, 40],
        iconAnchor: [20, 20],
    });

    // Marcadores
    L.marker(origin, { icon: businessIcon }).addTo(map)
     .bindPopup('<b>Restaurante</b>');
     
    L.marker(destination, { icon: homeIcon }).addTo(map)
     .bindPopup('<b>Tu ubicación</b>');

    // Marcador del dron
    let droneMarker = L.marker(origin, { 
        icon: droneIcon,
        zIndexOffset: 1000
    }).addTo(map).bindPopup('Tu pedido');

    // Línea de ruta
    let routeLine = L.polyline([origin, destination], {
        color: '#ff441f',
        weight: 3,
        dashArray: '10, 10',
    }).addTo(map);

    // Actualizar posición
    async function updatePosition() {
        try {
            const res = await fetch('{{ route("pedidos.position", $order->id) }}');
            const { lat, lng } = await res.json();
            
            droneMarker.setLatLng([lat, lng]);
            routeLine.setLatLngs([[lat, lng], destination]);
            map.setView([lat, lng]);
            
            document.getElementById('loadingStatus').innerHTML = 
                `<span class="loading-spinner"></span> Actualizando...`;
                
            setTimeout(() => {
                document.getElementById('loadingStatus').textContent = 
                    'Última actualización: ' + new Date().toLocaleTimeString();
            }, 1000);
        } catch (e) {
            console.error('Error:', e);
            document.getElementById('loadingStatus').textContent = 
                'Error al actualizar posición';
        }
    }

    // Actualizar cada 5 segundos
    updatePosition();
    setInterval(updatePosition, 5000);
    
    document.getElementById('loadingStatus').innerHTML = 
        `<span class="loading-spinner"></span> Conectando con el dron...`;
@endif
</script>

<div id="loadingStatus" class="loading-status"></div>

@endsection