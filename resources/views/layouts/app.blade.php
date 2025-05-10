<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>

  <title>@yield('title', 'Home Delivery')</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    /* Reset & Base */
    * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    body {
      background-color: #f9f9f9;
      color: #333;
      padding-top: 80px; /* espacio para navbar fija */
    }
    a { text-decoration: none; color: inherit; }

    /* Navbar */
    .navbar { /* ... tu CSS ... */ }

    /* Contenedor principal, ahora más genérico */
    .main-container {
      padding: 20px 5% 80px;
      max-width: 1200px;
      margin: 0 auto;
    }

    /* Títulos secciones */
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

  {{-- Navbar --}}
  @include('partials.navbar')

  {{-- Mensajes flash / errores --}}
  <main class="main-container">
    {{-- FLASH MESSAGE --}}
    @if(session('status'))
      <div
        id="flash-message"
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6"
        role="alert"
      >
        {{ session('status') }}
      </div>
      <script>
        // Espera 3 segundos y oculta/elimina el mensaje
        setTimeout(() => {
          const flash = document.getElementById('flash-message');
          if (flash) {
            // opcional: animar opacidad antes de eliminar
            flash.style.transition = 'opacity 0.5s';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500);
          }
        }, 3000);
      </script>
    @endif
  
    @if($errors->any())
      {{-- ... tu bloque de errores ... --}}
    @endif
  
    @yield('content')
  </main>

  {{-- JS global (opcional: elimina o ajusta) --}}
  <script>
    // Si ya no usas /agregar-al-carrito/{id}, elimina esta función
    function agregarAlCarrito(idProducto) {
      fetch(`/cart`, {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ producto_id: idProducto /*, establecimiento_* campos... */ })
      })
      .then(r => r.ok
             ? alert('👍 Agregado al carrito')
             : alert('❌ Error al agregar'))
      .catch(() => alert('❌ Error de conexión'));
    }
  </script>

  {{-- Scripts específicos de cada vista --}}
  @stack('scripts')
</body>
</html>
