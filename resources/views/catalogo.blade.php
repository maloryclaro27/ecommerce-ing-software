@extends('layouts.app')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Home Delivery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        *
        /* Contenido principal */
        .catalogo-container {
            padding: 30px 5% 80px;
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
            transform: translateX(600%);
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
    
    <!-- Contenido principal -->
    <div class="catalogo-container">
        <h1 class="section-title">Nuestro Catálogo</h1>

        <div class="categorias-grid">
            @foreach($categorias as $cat)
                <div class="categoria-card">
                    <img src="{{ $cat->imagen }}"
                         alt="{{ $cat->titulo }}"
                         class="categoria-img">
                    <div class="categoria-info">
                        <h3>{{ $cat->titulo }}</h3>
                        <p>{{ $cat->descripcion }}</p>
                        <a href="{{ route('catalogo.' . $cat->slug) }}"
                           class="categoria-btn">
                            Ver opciones
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>