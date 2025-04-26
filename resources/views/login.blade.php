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
        
        .illustration-section::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }
        
        .illustration-section::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }
        
        .illustration-img {
            width: 100%;
            max-width: 300px;
            margin-bottom: 30px;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.1));
            animation: float 6s ease-in-out infinite;
        }
        
        .illustration-title {
            font-size: 2rem;
            margin-bottom: 15px;
            text-align: center;
            z-index: 2;
        }
        
        .illustration-text {
            text-align: center;
            opacity: 0.9;
            z-index: 2;
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
            margin-bottom: 30px;
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
            transition: all 0.3s;
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
            transition: all 0.3s;
        }
        
        .form-input:focus + .input-icon {
            color: #ff441f;
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
        
        .password-toggle:hover {
            color: #ff441f;
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
        
        .submit-btn:active {
            transform: translateY(0);
        }
        
        .forgot-password {
            display: block;
            text-align: right;
            margin-top: 10px;
            color: #666;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .forgot-password:hover {
            color: #ff441f;
            text-decoration: underline;
        }
        
        .register-link {
            margin-top: 20px;
            color: #666;
        }
        
        .register-link a {
            color: #ff441f;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        /* Validación interactiva */
        .validation-message {
            font-size: 0.85rem;
            margin-top: 8px;
            color: #ff441f;
            height: 0;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .form-group.error .validation-message {
            height: 20px;
        }
        
        .form-group.error .form-input {
            border-color: #ff441f;
            background-color: #fff0f0;
        }
        
        .form-group.success .form-input {
            border-color: #4CAF50;
            background-color: #f0fff0;
        }
        
        .form-group.success .input-icon {
            color: #4CAF50;
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
        
        /* Animaciones */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            
            .illustration-section {
                padding: 30px;
            }
            
            .form-section {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    
    <div class="login-container">
        <!-- Sección de ilustración -->
        <div class="illustration-section">
            <img src="https://cdn-icons-png.flaticon.com/512/2997/2997153.png" alt="Login Illustration" class="illustration-img">
            <h2 class="illustration-title">¡Bienvenido de vuelta!</h2>
            <p class="illustration-text">Inicia sesión para acceder a tus pedidos, favoritos y descuentos exclusivos</p>
        </div>
        
        <!-- Sección del formulario -->
        <div class="form-section">
            <!-- Efectos decorativos -->
            <div class="auth-decoration decoration-1"></div>
            <div class="auth-decoration decoration-2"></div>
            
            <h1 class="form-title">Iniciar Sesión</h1>
            <p class="form-subtitle">Ingresa tus credenciales para acceder a tu cuenta</p>
            
            <form id="loginForm">
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" id="email" class="form-input" placeholder="tucorreo@ejemplo.com" required>
                    <i class="fas fa-envelope input-icon"></i>
                    <div class="validation-message">Por favor ingresa un correo válido</div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" class="form-input" placeholder="••••••••" required>
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                    <i class="fas fa-lock input-icon"></i>
                    <div class="validation-message">La contraseña es requerida</div>
                    <a href="password.html" class="forgot-password">¿Olvidaste tu contraseña?</a>
                </div>
                
                <div class="form-footer">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                    </button>
                    <p class="register-link">¿No tienes una cuenta? <a href="{{ route('registro') }}">Regístrate</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Validación en tiempo real
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            
            // Mostrar/ocultar contraseña
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
                this.classList.toggle('fa-eye');
            });
            
            // Validación mientras escribe
            emailInput.addEventListener('input', function() {
                validateEmail(this);
            });
            
            passwordInput.addEventListener('input', function() {
                validatePassword(this);
            });
            
            // Validación al enviar el formulario
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let isValid = true;
                
                if (!validateEmail(emailInput)) isValid = false;
                if (!validatePassword(passwordInput)) isValid = false;
                
                if (isValid) {
                    // Simulación de envío exitoso
                    form.innerHTML = `
                        <div style="text-align: center; animation: fadeInUp 0.5s ease-out;">
                            <i class="fas fa-check-circle" style="font-size: 4rem; color: #4CAF50; margin-bottom: 20px;"></i>
                            <h2 style="color: #333; margin-bottom: 15px;">¡Bienvenido de vuelta!</h2>
                            <p style="color: #666; margin-bottom: 30px;">Has iniciado sesión correctamente. Redirigiendo a tu cuenta...</p>
                            <div class="spinner" style="margin: 0 auto; width: 50px; height: 50px; border: 5px solid #f3f3f3; border-top: 5px solid #ff441f; border-radius: 50%; animation: spin 1s linear infinite;"></div>
                        </div>
                    `;
                    
                    // Redirección simulada
                    setTimeout(() => {
                        window.location.href = "{{ route('welcome') }}"; // Asegúrate que 'home' existe
                    }, 2000);
                }
            });
            
            // Función de validación de email
            function validateEmail(input) {
                const formGroup = input.parentElement;
                const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value.trim());
                
                if (input.value.trim() === '') {
                    formGroup.classList.remove('success');
                    formGroup.classList.remove('error');
                    return false;
                } else if (isValid) {
                    formGroup.classList.remove('error');
                    formGroup.classList.add('success');
                    return true;
                } else {
                    formGroup.classList.remove('success');
                    formGroup.classList.add('error');
                    return false;
                }
            }
            
            // Función de validación de contraseña
            function validatePassword(input) {
                const formGroup = input.parentElement;
                const isValid = input.value.length >= 8;
                
                if (input.value.trim() === '') {
                    formGroup.classList.remove('success');
                    formGroup.classList.remove('error');
                    return false;
                } else if (isValid) {
                    formGroup.classList.remove('error');
                    formGroup.classList.add('success');
                    return true;
                } else {
                    formGroup.classList.remove('success');
                    formGroup.classList.add('error');
                    return false;
                }
            }
        });
    </script>
</body>
</html>