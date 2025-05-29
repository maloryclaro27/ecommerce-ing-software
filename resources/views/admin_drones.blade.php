@extends('layouts.app')

@section('content')
<style>
    .drones-container {
        padding: 80px 5% 60px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .section-title {
        font-size: 2.2rem;
        color: #333;
        text-align: center;
        margin-bottom: 40px;
        position: relative;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background-color: #ff441f;
    }

    .drones-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        margin-top: 30px;
    }

    .drone-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 25px;
        position: relative;
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
        min-height: 300px;
        display: flex;
        flex-direction: column;
    }

    .drone-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .drone-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        padding: 6px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        z-index: 2;
    }

    .badge-active {
        background-color: #e8f5e9;
        color: #2e7d32;
    }

    .badge-busy {
        background-color: #fff3e0;
        color: #e65100;
    }

    .badge-inactive {
        background-color: #ffebee;
        color: #c62828;
    }

    .drone-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .drone-id {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 5px;
    }

    .drone-name {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }

    .drone-image-container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 15px 0;
    }

    .drone-image {
        width: 120px;
        height: 120px;
        object-fit: contain;
        animation: float 6s ease-in-out infinite;
        opacity: 0.9;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }

    .drone-details {
        margin-top: auto;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #f5f5f5;
    }

    .detail-label {
        color: #666;
        font-size: 0.9rem;
    }

    .detail-value {
        font-weight: 500;
        color: #333;
    }

    .drone-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .action-btn {
        flex: 1;
        padding: 10px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }

    .edit-btn {
        background-color: #ff441f;
        color: white;
    }

    .edit-btn:hover {
        background-color: #e03a1a;
    }

    .track-btn {
        background-color: #2196f3;
        color: white;
    }

    .track-btn:hover {
        background-color: #1976d2;
    }

    .add-drone-btn {
        position: fixed;
        bottom: 40px;
        right: 40px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #ff441f;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 5px 20px rgba(255, 68, 31, 0.3);
        cursor: pointer;
        transition: all 0.3s;
        z-index: 10;
        border: none;
    }

    .add-drone-btn:hover {
        transform: scale(1.1);
        background-color: #e03a1a;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        grid-column: 1 / -1;
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
        font-size: 3.5rem;
        color: #ccc;
        margin-bottom: 20px;
    }

    .empty-text {
        color: #666;
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .drones-grid {
            grid-template-columns: 1fr;
        }
        
        .add-drone-btn {
            bottom: 20px;
            right: 20px;
        }
    }
</style>

<div class="drones-container">
    <h1 class="section-title">Administración de Drones</h1>
    
    <div class="drones-grid">
        @foreach($drones as $drone)
        <div class="drone-card">
            <span class="drone-badge 
                @if($drone->estado == 'activo') badge-active
                @elseif($drone->estado == 'ocupado') badge-busy
                @else badge-inactive @endif">
                {{ ucfirst($drone->estado) }}
            </span>
            
            <div class="drone-content">
                <div class="drone-id">ID #{{ $drone->id }}</div>
                <h3 class="drone-name">{{ $drone->tipo }}</h3>
                
                <div class="drone-image-container">
                    <img src="{{ asset('img/Home1.png') }}" alt="Dron" class="drone-image">
                </div>
                
                <div class="drone-details">
                    <div class="detail-item">
                        <span class="detail-label">Ubicación</span>
                        <span class="detail-value">
                            @if($drone->lat && $drone->lng)
                                {{ number_format($drone->lat, 4) }}, {{ number_format($drone->lng, 4) }}
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Última actualización</span>
                        <span class="detail-value">{{ $drone->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Batería</span>
                        <span class="detail-value">
                            <span style="color: #4caf50;">85%</span>
                        </span>
                    </div>
                </div>
                
                <div class="drone-actions">
                    <button class="action-btn edit-btn">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="action-btn track-btn">
                        <i class="fas fa-map-marked-alt"></i> Rastrear
                    </button>
                </div>
            </div>
        </div>
        @endforeach
        
        @if($drones->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-drone-alt"></i>
            </div>
            <h3 class="empty-text">No hay drones registrados</h3>
        </div>
        @endif
    </div>
    
    <button class="add-drone-btn" title="Añadir nuevo dron">
        <i class="fas fa-plus"></i>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Efecto hover mejorado para las cards
        const cards = document.querySelectorAll('.drone-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.borderColor = '#ff441f';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.borderColor = '#f0f0f0';
            });
        });
        
        // Botón de añadir dron
        const addBtn = document.querySelector('.add-drone-btn');
        addBtn.addEventListener('click', function() {
            // Aquí iría la lógica para añadir un nuevo dron
            alert('Funcionalidad para añadir nuevo dron');
        });
        
        // Botones de acción
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const droneId = this.closest('.drone-card').querySelector('.drone-id').textContent.replace('ID #', '');
                alert(`Editar dron ${droneId}`);
            });
        });
        
        document.querySelectorAll('.track-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const droneId = this.closest('.drone-card').querySelector('.drone-id').textContent.replace('ID #', '');
                alert(`Rastrear dron ${droneId}`);
            });
        });
        
        // Click en card
        document.querySelectorAll('.drone-card').forEach(card => {
            card.addEventListener('click', function() {
                const droneId = this.querySelector('.drone-id').textContent.replace('ID #', '');
                alert(`Ver detalles del dron ${droneId}`);
            });
        });
    });
</script>
@endsection