<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Home Delivery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        /* Contenedor principal */
        .login-container {
            max-width: 800px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            animation: fadeInUp 0.8s ease-out;
        }
        /* Sección izquierda - Ilustración */
        .illustration-section {
            flex: 1;
            background: linear-gradient(135deg, #ff441f 0%, #ff6b3d 100%);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .illustration-img {
            width: 100%;
            max-width: 300px;
            margin-bottom: 30px;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.1));
            animation: float 6s ease-in-out infinite;
        }
        .illustration-title,
        .illustration-text {
            text-align: center;
            z-index: 2;
        }
        .illustration-title {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        .illustration-text {
            opacity: 0.9;
        }
        /* Sección derecha - Formulario */
        .form-section {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        .form-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }
        .form-subtitle {
            color: #666;
            margin-bottom: 15px;
            text-align: center;
        }
        .validation-summary {
            background-color: #ffe6e6;
            color: #cc0000;
            border: 1px solid #ffcccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }
        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: #f9f9f9;
        }
        .form-input:focus {
            border-color: #ff441f;
            background-color: white;
            box-shadow: 0 5px 15px rgba(255, 68, 31, 0.1);
            outline: none;
        }
        .input-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }
        .password-toggle {
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            cursor: pointer;
            transition: all 0.3s;
        }
        .form-footer {
            margin-top: 20px;
            text-align: center;
        }
        .submit-btn {
            background: linear-gradient(135deg, #ff441f 0%, #ff6b3d 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 20px rgba(255, 68, 31, 0.3);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 68, 31, 0.4);
        }
        /* Animaciones */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%   { transform: translateY(0px); }
            50%  { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        @media (max-width: 768px) {
            .login-container { flex-direction: column; }
            .form-section,
            .illustration-section { padding: 30px; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Ilustración -->
        <div class="illustration-section">
            <img src="https://cdn-icons-png.flaticon.com/512/2997/2997153.png" alt="Login Illustration" class="illustration-img">
            <h2 class="illustration-title">¡Bienvenido de vuelta!</h2>
            <p class="illustration-text">Inicia sesión para acceder a tus pedidos, favoritos y descuentos exclusivos</p>
        </div>

        <!-- Formulario -->
        <div class="form-section">
            <h1 class="form-title">Iniciar Sesión</h1>
            <p class="form-subtitle">Ingresa tus credenciales para acceder a tu cuenta</p>

            <!-- Mostrar errores generales -->
            @if($errors->any())
                <div class="validation-summary">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                    <input
                        type="email"
                        name="correo_electronico"
                        id="correo_electronico"
                        class="form-input"
                        placeholder="tucorreo@ejemplo.com"
                        value="{{ old('correo_electronico') }}"
                        required
                    >
                    <i class="fas fa-envelope input-icon"></i>
                    @error('correo_electronico')
                        <div class="validation-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input
                        type="password"
                        name="contrasena"
                        id="contrasena"
                        class="form-input"
                        placeholder="••••••••"
                        required
                    >
                    <i class="fas fa-lock input-icon"></i>
                    <span id="togglePassword" class="fas fa-eye password-toggle"></span>
                    @error('contrasena')
                        <div class="validation-message">{{ $message }}</div>
                    @enderror
                    <a href="password.request" class="forgot-password">¿Olvidaste tu contraseña?</a>
                </div>

                <div class="form-footer">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                    </button>
                    <p class="register-link">
                        ¿No tienes una cuenta? <a href="{{ route('registro') }}">Regístrate</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Mostrar/ocultar contraseña
        document.getElementById('togglePassword').addEventListener('click', function() {
            const pwd = document.getElementById('contrasena');
            const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
            pwd.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    </script>
</body>
</html>
