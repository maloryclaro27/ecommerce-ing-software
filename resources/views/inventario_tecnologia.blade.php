@extends('layouts.app')
@section('title', 'Catálogo de ' . $tecnologia->nombre)
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
      position: relative;
      background: var(--card-bg);
      border-radius: 12px;
      box-shadow: 0 4px 12px var(--shadow);
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
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
      color: var(--text);
    }

    .producto-precio {
      font-size: 18px;
      color: var(--secondary);
      margin-bottom: 12px;
    }

    .btn-accion {
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 20px;
      padding: 8px 16px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }

    .btn-accion:hover {
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

    .btn-carrito-flotante {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background: var(--secondary);
      color: #fff;
      padding: 12px 20px;
      border-radius: 50px;
      font-size: 16px;
      text-decoration: none;
      box-shadow: 0 4px 12px var(--shadow);
      z-index: 1000;
      transition: background 0.3s, transform 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 10px;
    }

    .btn-carrito-flotante:hover {
      background: #1f8a4b;
      transform: scale(1.05);
    }

    .carrito-badge {
      background: red;
      color: white;
      border-radius: 50%;
      padding: 3px 8px;
      font-size: 14px;
      font-weight: bold;
      line-height: 1;
    }
  </style>

@if (session('alerta'))
<script>
  window.onload = function () {
    alert("{{ session('alerta') }}");

      // Elimina el mensaje de la sesión en el historial
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  }
</script>
@endif

  <h1 class="section-title">Catálogo de {{ $tecnologia->nombre }}</h1>

  {{-- Mensaje de confirmación --}}
  @if(session('success'))
    <div class="max-w-lg mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-center mb-6" role="alert">
      {{ session('success') }}
    </div>
  @endif

  <div class="productos-container">
    @php
      $TIPO_TECNOLOGIA = config('establecimientos.TIPO_TECNOLOGIA');
    @endphp

    @foreach($productos as $producto)
      <div class="producto-card">
        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="producto-img">
        <div class="producto-info">
          <h3>{{ $producto->nombre }}</h3>
          <p class="producto-precio">${{ number_format($producto->precio, 0, ',', '.') }}</p>

          <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
            <input type="hidden" name="establecimiento_id" value="{{ $tecnologia->id }}">
            <input type="hidden" name="establecimiento_tipo" value="{{ $TIPO_TECNOLOGIA }}">
            <button type="submit" class="btn-accion">
              <i class="fas fa-cart-plus"></i> Agregar al carrito
            </button>
          </form>
        </div>
        <div class="producto-descripcion">
          {{ $producto->descripcion }}
        </div>
      </div>
    @endforeach
  </div>

  {{-- Botón flotante con contador --}}
  <a href="{{ route('cart.index') }}" class="btn-carrito-flotante">
    <i class="fas fa-shopping-cart"></i> Ver carrito
    @if(isset($cartCount) && $cartCount > 0)
      <span class="carrito-badge">{{ $cartCount }}</span>
    @endif
  </a>
@endsection
