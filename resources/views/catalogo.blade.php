<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Home Delivery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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
        
        .categorias-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
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
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
        
        .categoria-info {
            padding: 25px 20px;
        }
        
        .categoria-info h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #ff441f;
        }
        
        .categoria-info p {
            color: #666;
            margin-bottom: 20px;
        }
        
        .categoria-btn {
            display: inline-block;
            padding: 10px 25px;
            background-color: #ff441f;
            color: white;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .categoria-btn:hover {
            background-color: #e03a1a;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 68, 31, 0.3);
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
    
    <!-- Contenido principal -->
    <div class="catalogo-container"> 
        <h1 class="section-title">Nuestro Catálogo</h1>
        
        <div class="categorias-grid">
            <!-- Comida -->
            <div class="categoria-card">
                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Comida" class="categoria-img">
                <div class="categoria-info">
                    <h3>Comida</h3>
                    <p>Descubre los mejores restaurantes de la ciudad</p>
                    <a href="{{ route('catalogo.comida') }}" class="categoria-btn">Ver opciones</a>
                </div>
            </div>
            
            <!-- Droguería -->
            <div class="categoria-card">
                <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" alt="Droguería" class="categoria-img">
                <div class="categoria-info">
                    <h3>Droguería</h3>
                    <p>Medicamentos y productos de cuidado personal</p>
                    <a href="{{ route('catalogo.drogueria') }}" class="categoria-btn">Ver opciones</a>
                </div>
            </div>
            
            <!-- Ropa -->
            <div class="categoria-card">
                <img src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Ropa" class="categoria-img">
                <div class="categoria-info">
                    <h3>Ropa</h3>
                    <p>Las mejores tiendas de moda y accesorios</p>
                    <a href="{{ route('catalogo.ropa') }}" class="categoria-btn">Ver opciones</a>
                </div>
            </div>
            
            <!-- Tecnología -->
            <div class="categoria-card">
                <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Tecnología" class="categoria-img">
                <div class="categoria-info">
                    <h3>Tecnología</h3>
                    <p>Los últimos dispositivos y gadgets tecnológicos</p>
                    <a href="{{ route('catalogo.tecnologia') }}" class="categoria-btn">Ver opciones</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>