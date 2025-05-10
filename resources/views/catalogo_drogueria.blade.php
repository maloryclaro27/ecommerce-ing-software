@extends('layouts.app')

@section('title', 'Droguerías - Home Delivery')

@section('content')
<style>
    .catalogo-container {
        padding: 120px 5% 80px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .section-title {
        font-size: 2.5rem;
        margin-bottom: 30px;
        color: #333;
        position: relative;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 0;
        width: 80px;
        height: 4px;
        background-color: #ff441f;
    }
    .restaurantes-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
    }
    .restaurante-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
    }
    .restaurante-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    .restaurante-img {
        height: 180px;
        width: 100%;
        object-fit: cover;
    }
    .restaurante-info {
        padding: 20px;
    }
    .restaurante-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .restaurante-nombre {
        font-size: 1.3rem;
        font-weight: 600;
    }
    .restaurante-rating {
        color: #ffc107;
        font-weight: 600;
    }
    .restaurante-btn {
        display: inline-block;
        margin-top: 15px;
        padding: 8px 20px;
        background: #ff441f;
        color: white;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.3s;
    }
    .restaurante-btn:hover {
        background: #e03a1a;
    }
</style>

<div class="catalogo-container">
    <h1 class="section-title">Droguerías</h1>

    <div class="restaurantes-list">
        @foreach($droguerias as $drogueria)
            <div class="restaurante-card">
                <img
                    src="{{ $drogueria->imagen ?? 'https://via.placeholder.com/600x400?text=Sin+imagen' }}"
                    alt="Logo de {{ $drogueria->nombre }}"
                    class="restaurante-img"
                >
                <div class="restaurante-info">
                    <div class="restaurante-header">
                        <h3 class="restaurante-nombre">{{ $drogueria->nombre }}</h3>
                        <div class="restaurante-rating">
                            <i class="fas fa-star"></i> {{ $drogueria->rating }}
                        </div>
                    </div>
                    <a href="{{ route('droguerias.show', $drogueria->id) }}"
                       class="restaurante-btn">
                        Ver catálogo
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
