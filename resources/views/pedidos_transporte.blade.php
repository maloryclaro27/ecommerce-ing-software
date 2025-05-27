@extends('layouts.app')

@section('title', 'Seleccionar Medio de Transporte')

@section('content')
<style>
    .transport-container {
        padding: 100px 5% 80px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .section-title {
        font-size: 2.5rem;
        margin-bottom: 30px;
        color: #333;
        text-align: center;
        position: relative;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background-color: #ff441f;
    }

    .delivery-address {
        background: #fff8f6;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 40px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        border-left: 4px solid #ff441f;
    }

    .delivery-address strong {
        color: #ff441f;
        font-size: 1.1rem;
    }

    .transport-section {
        margin-bottom: 50px;
    }

    .transport-title {
        font-size: 1.8rem;
        color: #333;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 10px;
    }

    .transport-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background-color: #ff441f;
    }

    .transport-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
    }

    .transport-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 25px;
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .transport-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .transport-id {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .transport-info {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 8px;
    }

    .transport-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 10px;
    }

    .status-available {
        background-color: #e6f7e6;
        color: #2e7d32;
    }

    .status-unavailable {
        background-color: #ffebee;
        color: #c62828;
    }

    .select-btn {
        width: 100%;
        padding: 12px;
        border-radius: 30px;
        font-weight: bold;
        margin-top: 20px;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-available {
        background-color: #ff441f;
        color: white;
    }

    .btn-available:hover {
        background-color: #e03a1a;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 68, 31, 0.3);
    }

    .btn-unavailable {
        background-color: #f0f0f0;
        color: #999;
        cursor: not-allowed;
    }

    .transport-icon {
        font-size: 1.2rem;
    }

    /* Animaciones */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .transport-card {
        animation: fadeIn 0.5s ease forwards;
    }

    .transport-card:nth-child(1) { animation-delay: 0.1s; }
    .transport-card:nth-child(2) { animation-delay: 0.2s; }
    .transport-card:nth-child(3) { animation-delay: 0.3s; }
    .transport-card:nth-child(4) { animation-delay: 0.4s; }
    .transport-card:nth-child(5) { animation-delay: 0.5s; }

    /* Responsive */
    @media (max-width: 768px) {
        .transport-grid {
            grid-template-columns: 1fr;
        }
        
        .section-title {
            font-size: 2rem;
        }
    }
</style>

<div class="transport-container">
    <h1 class="section-title">Seleccionar Medio de Transporte</h1>
    
    @if($order->shippingDetail)
    <div class="delivery-address">
        <strong>Dirección de entrega:</strong>
        <p>{{ $order->shippingDetail->direccion }}</p>
    </div>
    @endif

    {{-- Sección Drones --}}
    <div class="transport-section">
        <h2 class="transport-title">
            <i class="fas fa-drone-alt transport-icon"></i> Drones Disponibles
        </h2>
        <div class="transport-grid">
            @foreach($drones as $dron)
            <div class="transport-card">
                <h3 class="transport-id">Dron #{{ $dron->id }}</h3>
                <p class="transport-info">
                    <i class="fas fa-info-circle"></i> Estado: 
                    <span class="capitalize">{{ $dron->estado }}</span>
                </p>
                <p class="transport-info">
                    <i class="fas fa-battery-three-quarters"></i> Batería: 85%
                </p>
                <span class="transport-status {{ $dron->selectable ? 'status-available' : 'status-unavailable' }}">
                    {{ $dron->selectable ? 'Disponible' : 'No disponible' }}
                </span>

                <form action="{{ route('pedidos.transporte.asignar', $order->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="transporte_id" value="{{ $dron->id }}">
                    <button
                        type="submit"
                        class="select-btn {{ $dron->selectable ? 'btn-available' : 'btn-unavailable' }}"
                        {{ !$dron->selectable ? 'disabled' : '' }}
                    >
                        <i class="fas fa-check"></i>
                        {{ $dron->selectable ? 'Seleccionar Dron' : 'No disponible' }}
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Sección Motos --}}
    <div class="transport-section">
        <h2 class="transport-title">
            <i class="fas fa-motorcycle transport-icon"></i> Motos Disponibles
        </h2>
        <div class="transport-grid">
            @foreach($motos as $moto)
            <div class="transport-card">
                <h3 class="transport-id">Moto #{{ $moto->id }}</h3>
                <p class="transport-info">
                    <i class="fas fa-user"></i> Domiciliario: {{ $moto->nombre_domiciliario }}
                </p>
                <p class="transport-info">
                    <i class="fas fa-info-circle"></i> Estado: 
                    <span class="capitalize">{{ $moto->estado }}</span>
                </p>
                <span class="transport-status {{ $moto->selectable ? 'status-available' : 'status-unavailable' }}">
                    {{ $moto->selectable ? 'Disponible' : 'No disponible' }}
                </span>

                <form action="{{ route('pedidos.transporte.asignar', $order->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="transporte_id" value="{{ $moto->id }}">
                    <button
                        type="submit"
                        class="select-btn {{ $moto->selectable ? 'btn-available' : 'btn-unavailable' }}"
                        {{ !$moto->selectable ? 'disabled' : '' }}
                    >
                        <i class="fas fa-check"></i>
                        {{ $moto->selectable ? 'Seleccionar Moto' : 'No disponible' }}
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Sección Bicicletas --}}
    <div class="transport-section">
        <h2 class="transport-title">
            <i class="fas fa-bicycle transport-icon"></i> Bicicletas Disponibles
        </h2>
        <div class="transport-grid">
            @foreach($bicicletas as $bicicleta)
            <div class="transport-card">
                <h3 class="transport-id">Bicicleta #{{ $bicicleta->id }}</h3>
                <p class="transport-info">
                    <i class="fas fa-user"></i> Domiciliario: {{ $bicicleta->nombre_domiciliario }}
                </p>
                <p class="transport-info">
                    <i class="fas fa-info-circle"></i> Estado: 
                    <span class="capitalize">{{ $bicicleta->estado }}</span>
                </p>
                <span class="transport-status {{ $bicicleta->selectable ? 'status-available' : 'status-unavailable' }}">
                    {{ $bicicleta->selectable ? 'Disponible' : 'No disponible' }}
                </span>

                <form action="{{ route('pedidos.transporte.asignar', $order->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="transporte_id" value="{{ $bicicleta->id }}">
                    <button
                        type="submit"
                        class="select-btn {{ $bicicleta->selectable ? 'btn-available' : 'btn-unavailable' }}"
                        {{ !$bicicleta->selectable ? 'disabled' : '' }}
                    >
                        <i class="fas fa-check"></i>
                        {{ $bicicleta->selectable ? 'Seleccionar Bicicleta' : 'No disponible' }}
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Efecto hover mejorado para las tarjetas
        const cards = document.querySelectorAll('.transport-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                if (!card.querySelector('.select-btn').disabled) {
                    card.style.borderColor = '#ff441f';
                }
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.borderColor = '#f0f0f0';
            });
        });
        
        // Mostrar animación de carga al enviar formulario
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const button = this.querySelector('button[type="submit"]');
                if (button && !button.disabled) {
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Procesando...';
                    button.disabled = true;
                }
            });
        });
    });
</script>
@endsection