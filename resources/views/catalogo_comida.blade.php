@extends('layouts.app')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comida - Home Delivery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos base (igual que catalogo.blade.php) */

        /* Contenido principal */
        .catalogo-container {
            padding: 30px 5% 80px;
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
    
    <!-- Contenido principal -->
    <div class="catalogo-container">
        <h1 class="section-title">Restaurantes</h1>
        
        <!-- Filtros -->
        <div class="filtros">
            <div class="filtro-btn active">Todos</div>
            @foreach($tipos_comida as $tipo)
                <div class="filtro-btn">{{ $tipo }}</div>
            @endforeach
        </div>
        
            <!-- Listado dinámico de restaurantes -->
        <div class="restaurantes-list"> <!--Contenedor principal donde se van a listar todos los restaurantes. Va a agrupar todas las tarjetas (cards) de cada restaurante. -->
            @foreach($restaurantes as $restaurante) <!--el motor de plantillas de Laravel) para recorrer un arreglo o colección llamado $restaurantes. Por cada restaurante en ese listado, se ejecuta lo que está dentro del foreach. Es decir: por cada restaurante, genera una tarjeta nueva (<div class="restaurante-card">).. -->
                <div class="restaurante-card" data-tipo="{{ $restaurante->tipo }}"> <!-- Cada restaurante se mete dentro de una tarjeta (div).

                    Además, a esa tarjeta le agregas un atributo data-tipo, que guarda el tipo del restaurante (por ejemplo: Italiana, Japonesa, Comida Rápida...).
                    Esto del data-tipo es muy útil si después quieres hacer filtros con JavaScript (por ejemplo: filtrar solo "Comida japonesa"). -->
                    {{-- Si en tu tabla tienes columna 'imagen', úsala aquí --}}
                    <img
                    src="{{ $restaurante->imagen ?? 'https://via.placeholder.com/600x400?text=Sin+imagen' }}"
                    alt="Foto de {{ $restaurante->nombre }}"
                    class="restaurante-img"
                         class="restaurante-img">
                    <div class="restaurante-info">
                        <div class="restaurante-header">
                            <h3 class="restaurante-nombre">{{ $restaurante->nombre }}</h3>
                            <div class="restaurante-rating">
                                <i class="fas fa-star"></i> {{ $restaurante->rating }}
                            </div>
                        </div>
                        <div class="restaurante-tipo">{{ $restaurante->tipo }}</div>
                        <a href="{{ route('restaurantes.show', $restaurante->id) }}"
                           class="restaurante-btn">
                            Ver menú
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filtros = document.querySelectorAll('.filtro-btn');
            const restaurantes = document.querySelectorAll('.restaurante-card');
            
            filtros.forEach(filtro => {
                filtro.addEventListener('click', function() {
                    filtros.forEach(f => f.classList.remove('active'));
                    this.classList.add('active');
                    
                    const tipo = this.textContent.trim();
                    if (tipo === 'Todos') {
                        restaurantes.forEach(r => r.style.display = 'block');
                        return;
                    }
                    
                    restaurantes.forEach(restaurante => {
                        restaurante.style.display =
                            restaurante.dataset.tipo === tipo ? 'block' : 'none';
                    });
                });
            });
        });
    </script>
</body>
</html>