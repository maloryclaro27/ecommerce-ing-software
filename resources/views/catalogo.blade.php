@extends('layouts.app')

@section('title', 'Catálogo - Home Delivery')

@section('content')
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Contenedor principal */
        .catalogo-container {
            padding: 30px 5% 80px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 2.5rem;
            margin: 50px 0 30px;
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

        /* Grid de categorías */
        .categorias-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }
        .categoria-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            text-align: center;
        }
        .categoria-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }
        .categoria-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .categoria-info {
            padding: 20px;
        }
        .categoria-info h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #ff441f;
        }
        .categoria-info p {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.95rem;
            line-height: 1.4;
        }
        .categoria-btn {
            display: inline-block;
            padding: 8px 20px;
            background-color: #ff441f;
            color: white;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }
        .categoria-btn:hover {
            background-color: #e03a1a;
            transform: translateY(-2px);
        }

        /* Grid de productos */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }
        .product-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-content {
            padding: 20px;
        }
        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        .product-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #ff441f;
            margin-bottom: 8px;
        }
        .product-owner {
            font-size: 0.85rem;
            color: #666;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
        }
    </style>

    <div class="catalogo-container">
        {{-- Sección de categorías --}}
        <h1 class="section-title">Nuestras Categorías</h1>
        <div class="categorias-grid">
            @forelse($categorias as $cat)
                <div class="categoria-card">
                    <img src="{{ $cat->imagen }}" alt="{{ $cat->titulo }}" class="categoria-img">
                    <div class="categoria-info">
                        <h3>{{ $cat->titulo }}</h3>
                        <p>{{ $cat->descripcion }}</p>
                        <a href="{{ route('catalogo.show', $cat->slug) }}" class="categoria-btn">
                            Ver opciones
                        </a>
                    </div>
                </div>
            @empty
                <p>No hay categorías disponibles.</p>
            @endforelse
        </div>

        {{-- Sección de todos los productos --}}
        @isset($products)
            <h2 class="section-title">Todos los Productos</h2>
            <div class="products-grid">
                @forelse($products as $p)
                    <div class="product-card">
                        <img src="{{ asset($p->imagen) }}" alt="{{ $p->nombre }}" class="product-image">
                        <div class="product-content">
                            <h3 class="product-name">{{ $p->nombre }}</h3>
                            <p class="product-price">${{ number_format($p->precio, 2, ',', '.') }}</p>
                            <p class="product-owner">Vendido por: {{ $p->owner->nombre_negocio }}</p>
                        </div>
                    </div>
                @empty
                    <p>No hay productos disponibles.</p>
                @endforelse
            </div>
        @endisset
    </div>
@endsection
