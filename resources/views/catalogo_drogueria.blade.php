<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Droguerías - Home Delivery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Copia aquí TODO el CSS que usas en catalogo_comida.blade.php */
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
        a { text-decoration: none; color: inherit; }
        .navbar {
            position: fixed; top: 0; left: 0; width: 100%;
            display: flex; justify-content: space-between; align-items: center;
            padding: 20px 5%; background-color: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px); z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .logo { font-size: 24px; font-weight: bold; color: #ff441f; }
        .logo span { color: #333; }
        .nav-links { display: flex; gap: 30px; }
        .nav-links a { font-weight: 500; position: relative; padding: 5px 0; transition: color 0.3s; }
        .nav-links a:hover { color: #ff441f; }
        .nav-links a::after {
            content: ''; position: absolute; bottom: 0; left: 0; width: 0; height: 2px;
            background-color: #ff441f; transition: width 0.3s;
        }
        .nav-links a:hover::after { width: 100%; }
        .catalogo-container { padding: 120px 5% 80px; max-width: 1200px; margin: 0 auto; }
        .section-title {
            font-size: 2.5rem; margin-bottom: 30px; color: #333; position: relative;
        }
        .section-title::after {
            content: ''; position: absolute; bottom: -15px; left: 0; width: 80px;
            height: 4px; background-color: #ff441f;
        }
        .restaurantes-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        .restaurante-card {
            background: white; border-radius: 15px; overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); transition: all 0.3s;
        }
        .restaurante-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .restaurante-img {
            height: 180px; width: 100%; object-fit: cover;
        }
        .restaurante-info { padding: 20px; }
        .restaurante-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 10px;
        }
        .restaurante-nombre {
            font-size: 1.3rem; font-weight: 600;
        }
        .restaurante-rating {
            color: #ffc107; font-weight: 600;
        }
        .restaurante-btn {
            display: inline-block; margin-top: 15px;
            padding: 8px 20px; background: #ff441f; color: white;
            border-radius: 5px; font-weight: 500; transition: all 0.3s;
        }
        .restaurante-btn:hover {
            background: #e03a1a;
        }
        @media (max-width: 768px) {
            .navbar { padding: 15px 5%; }
            .nav-links { gap: 15px; }
            .section-title { font-size: 2rem; }
            .restaurantes-list { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <!-- Navbar igual al de comida -->
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
                        <a href="{{ route('catalogo.drogueria.show', $drogueria->id) }}"
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
