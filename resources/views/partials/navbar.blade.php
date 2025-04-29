<style>
    /* Estilos base (igual que catalogo.blade.php) */
    * {
        margin: 0
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
    /* Ajuste específico para el icono de carrito */
.nav-links .nav-cart {
font-size: 20px;
padding: 5px 0;
}

.nav-links .nav-cart::after {
/* opcional: iguala el subrayado al icono */
content: '';
position: absolute;
bottom: -4px;
left: 0;
width: 100%;
height: 2px;
background-color: transparent;
transition: background-color 0.3s;
}
    .btn-carrito {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--secondary);
        color: #fff;
        padding: 12px 18px;
        border: none;
        border-radius: 30px;
        font-size: 16px;
        box-shadow: 0 4px 12px var(--shadow);
        transition: background 0.3s, transform 0.2s;
        z-index: 50;
    }
    .btn-carrito:hover {
    background: #1f8a4b;
    transform: translateY(-2px);
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
      <a href="carrito.html" class="nav-cart">
        <i class="fas fa-shopping-cart"></i>
      </a>
    </div>
  </nav>
</body>