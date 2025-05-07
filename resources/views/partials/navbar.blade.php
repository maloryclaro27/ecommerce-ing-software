{{-- resources/views/layouts/navbar.blade.php --}}
<style>
    /* Estilos base */
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

    /* Navbar */
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
        align-items: center;
    }
    .nav-links a,
    .nav-links button {
        font-weight: 500;
        position: relative;
        padding: 5px 0;
        background: none;
        border: none;
        cursor: pointer;
        color: inherit;
        transition: color 0.3s;
    }
    .nav-links a:hover,
    .nav-links button:hover {
        color: #ff441f;
    }
    .nav-links a::after,
    .nav-links button::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #ff441f;
        transition: width 0.3s;
    }
    .nav-links a:hover::after,
    .nav-links button:hover::after {
        width: 100%;
    }
    /* Carrito */
    .nav-cart {
        font-size: 20px;
        padding: 5px 0;
    }
    .nav-cart::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: transparent;
    }
</style>

<nav class="navbar">
  <a href="{{ route('welcome') }}" class="logo">
    Home<span>Delivery</span>
  </a>

  <div class="nav-links">
    <a href="{{ route('welcome') }}">Inicio</a>
    @guest
      <a href="{{ route('login') }}">Ingresar</a>
    @endguest
    @guest
    <a href="{{ route('servicios') }}">Servicios</a>
    @endguest
    @auth
      <a href="{{ route('servicios') }}">Servicios</a>
    @endauth
    <a href="#">Clientes</a>
    <a href="#">FAQ</a>
    
    <!-- Icono de carrito -->
    <a href="carrito.index" class="nav-cart">
      <i class="fas fa-shopping-cart"></i>
    </a>
    
    

    

    <!-- Logout como icono, solo usuarios autenticados -->
    @auth
  <form method="GET" action="{{ route('logout') }}" style="display:inline; margin-left:15px;">
    @csrf
    <button type="submit" class="nav-logout" style="background:none; border:none; cursor:pointer; padding:0;">
      <i class="fas fa-sign-out-alt" title="Cerrar sesión"></i>
    </button>
  </form>
@endauth

  </div>
</nav>
