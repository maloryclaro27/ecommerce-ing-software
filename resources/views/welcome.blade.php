@extends('layouts.app')

<style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        /* Hero Section */
        .hero {
            background-color: rgb(300, 68, 31); /* Naranja intenso */
            min-height: 80vh; /* 80% del alto de la pantalla */
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 0px; /* distancia del background con el navbar */
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            text-align: center;
            color: white; /*Esto es para la imagen, el titulo y la descripcion */
            z-index: 2; /* Sobre cualquier elemento posicionado */
            padding: 20px;
        }
        
        .hero-logo {
            width: 400px;
            margin-bottom: 20px;
            animation: float 3s ease-in-out infinite; /* Logo principal: Ancho fijo de 200px, Margen inferior, Animación "float" (flotar) */
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 30px;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); } /*animacion de flotar */
            100% { transform: translateY(0px); }
        }
        
        /* Servicios Section */
        .section {
            padding: 80px 5%;
            text-align: center;
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
            transform: translateX(800%); /*raya debajo del titulo */
            width: 80px;
            height: 4px;
            background-color: #ff441f;
        }
        
        .services-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 30px;
        }
        
        .service-card {
            background: white;
            border-radius: 15px;
            width: 300px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .service-icon {
            font-size: 3rem;
            color: #ff441f;
            margin-bottom: 20px;
        }
        
        .service-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        .service-card p {
            color: #666;
            margin-bottom: 20px;
        }
        
        .service-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff441f;
            color: white;
            border-radius: 30px;
            transition: background-color 0.3s;
        }
        
        .service-btn:hover {
            background-color: #e03a1a;
        }
        
        /* Restaurantes Section */
        .restaurants-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 30px;
        }
        
        .restaurant-card {
            background: white;
            border-radius: 15px;
            width: 250px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
        }
        
        .restaurant-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .restaurant-img {
            height: 180px;
            width: 100%;
            object-fit: cover;
        }
        
        .restaurant-info {
            padding: 20px;
        }
        
        .restaurant-info h3 {
            font-size: 1.3rem;
            margin-bottom: 10px;
        }
        
        .restaurant-info p {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        
        .rating {
            color: #ffc107;
            margin-bottom: 15px;
        }
        
        .view-btn {
            display: inline-block;
            padding: 8px 15px;
            border: 1px solid #ff441f;
            color: #ff441f;
            border-radius: 30px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .view-btn:hover {
            background-color: #ff441f;
            color: white;
        }
        
        /* Unete Section */
        .join-section {
            background-color: #ff441f;
            color: white;
            text-align: center;
            padding: 80px 5%;
        }
        
        .join-section .section-title {
            color: white;
        }
        
        .join-section .section-title::after {
            background-color: white;
        }
        
        .join-content {
            max-width: 700px;
            margin: 0 auto;
        }
        
        .join-content p {
            margin-bottom: 30px;
            font-size: 1.1rem;
        }
        
        .join-btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: white;
            color: #ff441f;
            border-radius: 30px;
            font-weight: bold;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .join-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
        /* Footer */
        footer {
            background-color: #222;
            color: #ddd;
            padding: 50px 5% 20px;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-column {
            flex: 1;
            min-width: 200px;
        }
        
        .footer-column h3 {
            color: white;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }
        
        .footer-column ul {
            list-style: none;
        }
        
        .footer-column ul li {
            margin-bottom: 10px;
        }
        
        .footer-column ul li a {
            transition: color 0.3s;
        }
        
        .footer-column ul li a:hover {
            color: #ff441f;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-links a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            background-color: #333;
            border-radius: 50%;
            transition: background-color 0.3s;
        }
        
        .social-links a:hover {
            background-color: #ff441f;
        }
        
        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #444;
            color: #999;
            font-size: 0.9rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 5%;
            }
            
            .nav-links {
                gap: 15px;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .service-card, .restaurant-card {
                width: 100%;
                max-width: 350px;
            }
        }
    </style>

<body>
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <img src="{{ asset('img/Home1.png') }}" alt="Home Delivery Logo" class="hero-logo">
            <h1>Tu pedido entregado por drones en minutos 🚀</h1>
            <p>Servicio de delivery rápido y confiable las 24 horas del día</p>
        </div>
    </section>
    
    <!-- Servicios Section -->
    <section class="section">
        <h2 class="section-title">Conoce nuestros servicios</h2>
        <div class="services-container">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Domicilio Directo</h3>
                <p>Recibe tus pedidos en minutos con nuestro servicio express disponible las 24 horas.</p>
                <a href="{{ route('servicios') }}" class="service-btn">Más información</a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Domicilio Programado</h3>
                <p>Programa tus entregas con anticipación para que lleguen justo cuando lo necesites.</p>
                <a href="{{ route('servicios') }}" class="service-btn">Más información</a>
            </div>
        </div>
    </section>
    
    <!-- Restaurantes Section -->
    <section class="section" style="background-color: #f5f5f5;">
        <h2 class="section-title">Los más elegidos</h2>
        <div class="restaurants-container">
            <div class="restaurant-card">
                <img src="https://1000marcas.net/wp-content/uploads/2019/12/Burger-King-logo.jpg" alt="Restaurante 1" class="restaurant-img">
                <div class="restaurant-info">
                    <h3>Burger King</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p>¡Pide online y disfruta de tus combos con delivery rápido!</p>
                    <a href="restaurante1.html" class="view-btn">Ver menú</a>
                </div>
            </div>
            
            <div class="restaurant-card">
                <img src="https://images.seeklogo.com/logo-png/5/1/farmatodo-logo-png_seeklogo-52092.png" alt="Restaurante 2" class="restaurant-img">
                <div class="restaurant-info">
                    <h3>Farmatodo</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <p>Tu farmacia de confianza. ¡Tu bienestar, nuestra prioridad!</p>
                    <a href="restaurante2.html" class="view-btn">Ver catálogo</a>
                </div>
            </div>
            
            <div class="restaurant-card">
                <img src="https://cdn.worldvectorlogo.com/logos/adidas-2.svg" alt="Restaurante 3" class="restaurant-img">
                <div class="restaurant-info">
                    <h3>Adidas</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>Tecnología deportiva y estilo. ¡Compra online seguro!</p>
                    <a href="restaurante3.html" class="view-btn">Ver catálogo</a>
                </div>
            </div>
            
            <div class="restaurant-card">
                <img src="https://pngimg.com/d/apple_logo_PNG19688.png" alt="Restaurante 4" class="restaurant-img">
                <div class="restaurant-info">
                    <h3>Apple Store</h3>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p>Compra iPhone, Mac, iPad y más. Envíos rápidos.</p>
                    <a href="restaurante4.html" class="view-btn">Ver catálogo</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Únete Section -->
    <section class="join-section">
        <h2 class="section-title">Únete a Home Delivery</h2>
        <div class="join-content">
            <p>¿Tienes algún negocio y quieres llegar a más clientes? Únete a nuestra plataforma y aumenta tus ventas con nuestro servicio de delivery confiable y eficiente.</p>
            <a href="registro-restaurantes.html" class="join-btn">Registra tu negocio</a>
        </div>
    </section>
    
    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>Home Delivery</h3>
                <p>El mejor servicio de delivery de la ciudad, conectando tiendas con clientes desde 2025.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            
            <div class="footer-column">
                <h3>Enlaces rápidos</h3>
                <ul>
                    <li><a href="{{ route('ingreso') }}">Ingreso</a></li>
                    <li><!-- En tu welcome.blade.php o layout principal -->
                        <a href="{{ route('servicios') }}">Servicios</a></li></li>
                    <li><a href="clientes.html">Clientes</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>Contacto</h3>
                <ul>
                    <li><i class="fas fa-phone"></i> +7 3154453445</li>
                    <li><i class="fas fa-envelope"></i> info@homedelivery.com</li>
                    <li><i class="fas fa-map-marker-alt"></i> Av. El Jardín #46, Bucaramanga</li>
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            <p>© 2025 Home Delivery Inc. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>