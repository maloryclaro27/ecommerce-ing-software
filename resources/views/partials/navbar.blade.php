{{-- resources/views/layouts/navbar.blade.php --}}
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

  .nav-cart {
      font-size: 20px;
      padding: 5px 0;
  }

  .dropdown {
      position: relative;
  }

  .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      z-index: 999;
      width: 200px;
      overflow: hidden;
  }

  .dropdown-menu a,
  .dropdown-menu button {
      display: block;
      width: 100%;
      text-align: left;
      padding: 10px 20px;
      color: #333;
      background: none;
      border: none;
      cursor: pointer;
  }

  .dropdown-menu a:hover,
  .dropdown-menu button:hover {
      background-color: #f5f5f5;
  }
</style>

<nav class="navbar">
  <a href="{{ route('welcome') }}" class="logo">Home<span>Delivery</span></a>

  <div class="nav-links">
      @guest
          <a href="{{ route('welcome') }}">Inicio</a>
          <a href="{{ route('login') }}">Servicios</a>
          <a href="{{ route('informacion') }}">FAQ</a>
          <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Iniciar Sesión</a>
      @endguest

      @auth
          <a href="{{ route('welcome') }}">Inicio</a>
          <a href="{{ route('servicios') }}">Servicios</a>

          <a href="carrito.index" class="nav-cart">
              <i class="fas fa-shopping-cart"></i>
          </a>

          <div class="dropdown"
               onmouseenter="this.querySelector('.dropdown-menu').style.display='block'"
               onmouseleave="this.querySelector('.dropdown-menu').style.display='none'">
              <button>Mi Cuenta</button>
              <div class="dropdown-menu">
                  <a href="perfil">Perfil</a>
                  <a href="historial.pedidos">Historial de pedidos</a>
                  <a href="puntos">Puntos HD</a>
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit">Cerrar sesión</button>
                  </form>
              </div>
          </div>
      @endauth
  </div>
</nav>
