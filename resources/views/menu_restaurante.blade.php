@extends('layouts.app')

@section('title', 'Menú de ' . $restaurante->nombre)

@section('content')
  <style>
    :root {
      --primary: #ff6b00;
      --primary-dark: #e65c00;
      --secondary: #27ae60;
      --bg: #f9f9f9;
      --card-bg: #ffffff;
      --text: #333333;
      --shadow: rgba(0,0,0,0.1);
    }

    .section-title {
      font-size: 2.5rem;
      margin-bottom: 50px;
      color: var(--text);
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
      background-color: var(--primary);
    }

    body {
      background: var(--bg);
      color: var(--text);
    }

    .productos-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 24px;
      padding: 40px 20px;
    }

    .producto-card {
      background: var(--card-bg);
      border-radius: 12px;
      box-shadow: 0 4px 12px var(--shadow);
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
      position: relative;
    }
    .producto-card:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 8px 20px var(--shadow);
    }

    .producto-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .producto-info {
      padding: 16px;
      text-align: center;
    }
    .producto-info h3 {
      font-size: 20px;
      margin-bottom: 8px;
    }
    .producto-precio {
      font-size: 18px;
      color: var(--secondary);
      margin-bottom: 12px;
    }

    .btn-agregar {
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 20px;
      padding: 8px 16px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }
    .btn-agregar:hover {
      background: var(--primary-dark);
      transform: scale(1.05);
    }

    .producto-descripcion {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      background: rgba(255,255,255,0.95);
      padding: 16px;
      text-align: center;
      font-size: 14px;
      color: #555;
      transform: translateY(-100%);
      transition: transform 0.3s ease;
      pointer-events: none;
      z-index: 1;
    }
    .producto-card:hover .producto-descripcion {
      transform: translateY(0);
    }

    .cart-button-wrapper {
      text-align: center;
      margin: 30px 0;
    }
    .btn-carrito {
      background: var(--secondary);
      color: #fff;
      padding: 12px 18px;
      border: none;
      border-radius: 30px;
      font-size: 16px;
      box-shadow: 0 4px 12px var(--shadow);
      transition: background 0.3s, transform 0.2s;
      text-decoration: none;
    }
    .btn-carrito:hover {
      background: #1f8a4b;
      transform: translateY(-2px);
    }
  </style>

  <h1 class="section-title">Menú de {{ $restaurante->nombre }}</h1>

  <div class="productos-container">
    @foreach($productos as $producto)
      <div class="producto-card">
        <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" class="producto-img">
        <div class="producto-info">
          <h3>{{ $producto->nombre }}</h3>
          <p class="producto-precio">${{ number_format($producto->precio, 0, ',', '.') }}</p>
          <form action="carrito.agregar" method="POST">
            @csrf
            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
            <button type="submit" class="btn-agregar">Agregar al carrito</button>
          </form>
        </div>
        <div class="producto-descripcion">
          {{ $producto->descripcion }}
        </div>
      </div>
    @endforeach
  </div>

  <div class="cart-button-wrapper">
    <a href="carrito.index" class="btn-carrito">
      <i class="fas fa-shopping-cart"></i> Ver carrito
    </a>
  </div>
@endsection
