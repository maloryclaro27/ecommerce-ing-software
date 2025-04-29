@extends('layouts.app')
@section('title', 'Catalogo de ' . $drogueria->nombre)
@section('content')
  <style>
    /* Variables de color */
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

    /* Contenedor de productos */
    .productos-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 24px;
      padding: 40px 20px;
    }

    /* Tarjeta de producto */
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

    /* Botón de acciones */
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

    /* Descripción deslizable */
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
  </style>
</head>
<body>

  <h1 class="section-title">Catálogo de {{ $drogueria->nombre }}</h1>

  <div class="productos-container">
    @foreach($productos as $producto)
      <div class="producto-card">
        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="producto-img">
        <div class="producto-info">
          <h3>{{ $producto->nombre }}</h3>
          <p class="producto-precio">${{ number_format($producto->precio, 0, ',', '.') }}</p>
          <button onclick="gestionarInventario({{ $producto->id }})" class="btn-accion">Añadir al carrito</button>
        </div>
        <div class="producto-descripcion">
          {{ $producto->descripcion }}
        </div>
      </div>
    @endforeach
  </div>

  <script>
    function gestionarInventario(idProducto) {
      // Función para modificar stock o detalles de inventario
      // Por ejemplo, abrir modal o redirigir a formulario de edición
      window.location.href = `/droguerias/{{ $drogueria->id }}/productos/${idProducto}/editar`;
    }
  </script>
@endsection
