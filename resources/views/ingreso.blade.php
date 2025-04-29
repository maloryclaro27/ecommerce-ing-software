@extends('layouts.app')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso - Home Delivery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos generales */
        
        /* Contenedor principal */
        .main-container {
            display: flex;
            min-height: 100vh;
            margin-top: 0px;
        }
        
        /* Sección izquierda - Imágenes interactivas */
        .benefits-section {
            flex: 1;
            padding: 50px;
            background-color: #fff8f6;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .benefits-title {
            font-size: 2rem;
            color: #ff441f;
            margin-bottom: 40px;
            text-align: center;
        }
        
        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            max-width: 600px;
        }
        
        .benefit-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(255, 68, 31, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-align: center;
            cursor: pointer;
            border: 2px solid transparent;
        }
        
        .benefit-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 15px 40px rgba(255, 68, 31, 0.2);
            border-color: #ff441f;
        }
        
        .benefit-icon {
            font-size: 2.5rem;
            color: #ff441f;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        
        .benefit-card:hover .benefit-icon {
            transform: rotate(15deg) scale(1.2);
        }
        
        .benefit-card h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: #333;
        }
        
        .benefit-card p {
            color: #666;
            font-size: 0.95rem;
        }
        
        /* Sección derecha - Formulario */
        .auth-section {
            flex: 1;
            padding: 80px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: white;
            position: relative;
        }
        
        .auth-container {
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        
        .auth-title {
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: #333;
            position: relative;
        }
        
        .auth-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: #ff441f;
        }
        
        .auth-subtitle {
            color: #666;
            margin-bottom: 40px;
            font-size: 1.1rem;
        }
        
        .auth-buttons {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .auth-btn {
            padding: 15px 30px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 1.1rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .login-btn {
            background-color: #ff441f;
            color: white;
            border: 2px solid #ff441f;
        }
        
        .login-btn:hover {
            background-color: #e03a1a;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 68, 31, 0.3);
        }
        
        .register-btn {
            background-color: white;
            color: #ff441f;
            border: 2px solid #ff441f;
        }
        
        .register-btn:hover {
            background-color: #fff0ed;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 68, 31, 0.2);
        }
        
        .auth-divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: #999;
        }
        
        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
        }
        
        .auth-divider::before {
            margin-right: 15px;
        }
        
        .auth-divider::after {
            margin-left: 15px;
        }
        
        .social-auth {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }
        
        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .social-btn:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        
        .facebook-btn {
            background-color: #3b5998;
        }
        
        .google-btn {
            background-color: #db4437;
        }
        
        .twitter-btn {
            background-color: #1da1f2;
        }
        
        /* Efectos decorativos */
        .auth-decoration {
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            background-color: rgba(255, 68, 31, 0.05);
            z-index: -1;
        }
        
        .decoration-1 {
            top: -100px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }
        
        .decoration-2 {
            bottom: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            animation: float 6s ease-in-out infinite reverse;
        }
        
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .main-container {
                flex-direction: column;
            }
            
            .benefits-section, .auth-section {
                padding: 50px 20px;
            }
            
            .benefits-grid {
                grid-template-columns: 1fr;
                max-width: 400px;
            }
        }
        
        @media (max-width: 576px) {
            .auth-title {
                font-size: 2rem;
            }
            
            .benefit-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    
    
    <!-- Contenedor principal -->
    <div class="main-container">
        <!-- Sección izquierda - Beneficios -->
        <section class="benefits-section">
            <h2 class="benefits-title">Descubre todo lo que puedes hacer con tu cuenta</h2>
            
            <div class="benefits-grid">
                <!-- Card 1 -->
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Envíos Express</h3>
                    <p>Accede a nuestro servicio prioritario de entregas en menos de 30 minutos</p>
                </div>
                
                <!-- Card 2 -->
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-percent"></i>
                    </div>
                    <h3>Descuentos Exclusivos</h3>
                    <p>Ofertas especiales solo para usuarios registrados</p>
                </div>
                
                <!-- Card 3 -->
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3>Historial de Pedidos</h3>
                    <p>Guarda y repite tus pedidos favoritos con un solo clic</p>
                </div>
                
                <!-- Card 4 -->
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h3>Programa de Recompensas</h3>
                    <p>Gana puntos con cada compra y canjéalos por beneficios</p>
                </div>
            </div>
        </section>
        
        <!-- Sección derecha - Autenticación -->
        <section class="auth-section">
            <!-- Efectos decorativos -->
            <div class="auth-decoration decoration-1"></div>
            <div class="auth-decoration decoration-2"></div>
            
            <div class="auth-container">
                <h1 class="auth-title">Regístrate o ingresa para continuar</h1>
                <p class="auth-subtitle">Accede a todos nuestros servicios sin restricciones</p>
                
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="auth-btn login-btn">
                        <i class="fas fa-user-plus"></i> Iniciar sesión
                    </a>
                    <a href="{{ route('registro') }}" class="auth-btn register-btn">
                        <i class="fas fa-user-plus"></i> Registrarse
                    </a>
                </div>
            </div>
        </section>
    </div>
</body>
</html>