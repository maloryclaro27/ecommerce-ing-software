<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Home Delivery')</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    /* Reset & Base */
    * {
      margin: 0; padding: 0; box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
      background-color: #f9f9f9;
      color: #333;
      padding-top: 80px; /* deja espacio para la navbar fija */
    }
    a {
      text-decoration: none;
      color: inherit;
    }

    /* Navbar (tu CSS original) */
    .navbar {
      position: fixed;
      top: 0; left: 0; width: 100%;
      display: flex; justify-content: space-between; align-items: center;
      padding: 20px 5%;
      background-color: rgba(255,255,255,0.9);
      backdrop-filter: blur(10px);
      z-index: 1000;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .logo {
      font-size: 24px; font-weight: bold;
      color: #ff441f;
      /* quitamos subrayado */
      text-decoration: none !important;
    }
    .logo span { color: #333; }
    .nav-links {
      display: flex; gap: 30px;
    }
    .nav-links a {
      font-weight: 500; position: relative; padding: 5px 0;
      transition: color 0.3s;
    }
    .nav-links a:hover { color: #ff441f; }
    .nav-links a::after {
      content: ''; position: absolute;
      bottom: 0; left: 0;
      width: 0; height: 2px;
      background-color: #ff441f;
      transition: width 0.3s;
    }
    .nav-links a:hover::after { width: 100%; }

    /* Icono carrito en navbar */
    .nav-links .nav-cart {
      font-size: 20px; padding: 5px 0;
    }
    .nav-links .nav-cart::after {
      content: ''; position: absolute;
      bottom: -4px; left: 0;
      width: 100%; height: 2px;
      background-color: transparent;
      transition: background-color 0.3s;
    }
    .nav-links .nav-cart:hover::after {
      background-color: #ff441f;
    }

    /* Contenedor principal */
    .catalogo-container {
      padding: 20px 5% 80px;  /* arriba el padding-top lo gestiona body */
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
      bottom: -15px; left: 0;
      width: 80px; height: 4px;
      background-color: #ff441f;
    }
  </style>
</head>
<body>

  {{-- aquí se inyecta tu partial con el HTML de la navbar --}}
  @include('partials.navbar')

  {{-- el contenido específico de cada vista --}}
  <main class="catalogo-container">
    @yield('content')
  </main>

  <script>
    // JS global: función para agregar productos al carrito
    function agregarAlCarrito(idProducto) {
      fetch(`/agregar-al-carrito/${idProducto}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json'
        }
      })
      .then(r => r.ok ? alert('👍 Agregado al carrito') : alert('❌ Error al agregar'))
      .catch(() => alert('❌ Error de conexión'));
    }
  </script>
</body>
</html>
