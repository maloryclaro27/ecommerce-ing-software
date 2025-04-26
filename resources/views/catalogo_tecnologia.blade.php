<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comida - Home Delivery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos base (igual que catalogo.blade.php) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
            color: #333;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        /* Navbar (igual que welcome) */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #ff441f;
        }
        
        .logo span {
            color: #333;
        }
        
        .nav-links {
            display: flex;
            gap: 30px;
        }
        
        .nav-links a {
            font-weight: 500;
            position: relative;
            padding: 5px 0;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: #ff441f;
        }
        
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #ff441f;
            transition: width 0.3s;
        }
        
        .nav-links a:hover::after {
            width: 100%;
        }
        
        /* Contenido principal */
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
        
        /* Filtros */
        .filtros {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .filtro-btn {
            padding: 8px 15px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .filtro-btn:hover, .filtro-btn.active {
            background: #ff441f;
            color: white;
            border-color: #ff441f;
        }
        
        /* Listado de restaurantes */
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
        
        .restaurante-tipo {
            display: inline-block;
            padding: 3px 10px;
            background: #f0f0f0;
            border-radius: 15px;
            font-size: 0.8rem;
            margin-bottom: 10px;
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
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 5%;
            }
            
            .nav-links {
                gap: 15px;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .restaurantes-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('welcome') }}" class="logo">Home<span>Delivery</span></a>
        <div class="nav-links">
            <a href="{{ route('welcome') }}">Inicio</a>
            <a href="{{ route('ingreso') }}">Ingreso</a>
            <a href="{{ route('servicios') }}">Servicios</a>
            <a href="clientes.html">Clientes</a>
            <a href="faq.html">FAQ</a>
        </div>
    </nav>

    <div class="catalogo-container">
        <h1 class="section-title">Tiendas de Tecnología</h1>

        <div class="restaurantes-list">
            @foreach($tiendas as $tienda)
                <div class="restaurante-card">
                    <img
                        src="{{ $tienda->imagen ?? 'https://via.placeholder.com/600x400?text=Sin+imagen' }}"
                        alt="Logo de {{ $tienda->nombre }}"
                        class="restaurante-img"
                    >
                    <div class="restaurante-info">
                        <div class="restaurante-header">
                            <h3 class="restaurante-nombre">{{ $tienda->nombre }}</h3>
                            <div class="restaurante-rating">
                                <i class="fas fa-star"></i> {{ $tienda->rating }}
                            </div>
                        </div>
                        <a href="{{ route('catalogo.tecnologia.show', $tienda->id) }}"
                           class="restaurante-btn">
                            Ver catálogo
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>