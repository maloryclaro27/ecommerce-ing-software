@extends('layouts.app')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros Servicios - Home Delivery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        
        /* Contenido principal */
        .services-container {
            padding: 30px 5% 80px; /* Aumenté padding-top para compensar navbar fijo */
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
            transform: translateX(600%); /*raya debajo del titulo */
            width: 80px;
            height: 4px;
            background-color: #ff441f;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
            margin-top: 50px;
        }
        
        .service-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .service-header {
            background: linear-gradient(135deg, #ff441f 0%, #ff6b3d 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .service-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
        }
        
        .service-title {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        
        .service-body {
            padding: 30px;
        }
        
        .service-features {
            margin-bottom: 30px;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .feature-icon {
            color: #ff441f;
            margin-right: 15px;
            font-size: 1.2rem;
        }
        
        .service-btn {
            display: inline-block;
            width: 100%;
            padding: 15px;
            background: #ff441f;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .service-btn:hover {
            background: #e03a1a;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 68, 31, 0.3);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 5%;
            }
            
            .nav-links {
                gap: 15px;
            }
            
            .services-grid {
                grid-template-columns: 1fr;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    
    <!-- Contenido principal -->
    <div class="services-container">
        <h1 class="section-title">Nuestros Servicios</h1>
        
        <div class="services-grid">
            <!-- Servicio 1: Domicilio Directo -->
            <div class="service-card">
                <div class="service-header">
                    <div class="service-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h2 class="service-title">Domicilio Directo</h2>
                </div>
                <div class="service-body">
                    <div class="service-features">
                        <div class="feature-item">
                            <i class="fas fa-check-circle feature-icon"></i>
                            <span>Entrega express en menos de 30 minutos</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle feature-icon"></i>
                            <span>Seguimiento en tiempo real del pedido</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle feature-icon"></i>
                            <span>Prioridad en la preparación</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle feature-icon"></i>
                            <span>Disponible 24/7</span>
                        </div>
                    </div>
                    <a href="{{ route('catalogo') }}" class="service-btn">Más información</a>
                </div>
            </div>
            
            <!-- Servicio 2: Mensajería -->
            <div class="service-card">
                <div class="service-header">
                    <div class="service-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h2 class="service-title">Domicilio Programado</h2>
                </div>
                <div class="service-body">
                    <div class="service-features">
                        <div class="feature-item">
                            <i class="fas fa-check-circle feature-icon"></i>
                            <span>Programación de entregas con anticipación</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle feature-icon"></i>
                            <span>Entrega de paquetes y documentos</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle feature-icon"></i>
                            <span>Seguimiento detallado</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle feature-icon"></i>
                            <span>Cobertura en toda la ciudad</span>
                        </div>
                    </div>
                    <a href="{{ route('domicilios_programados') }}" class="service-btn">Más información</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>