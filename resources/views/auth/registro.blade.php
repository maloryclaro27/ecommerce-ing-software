<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Home Delivery</title>
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
            background: linear-gradient(135deg, #fff8f6 0%, #ffebee 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        /* Contenedor principal */
        .register-container {
            max-width: 800px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(255, 68, 31, 0.2);
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
        
        .form-footer {
            margin-top: 30px;
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
        
        .login-link {
            margin-top: 20px;
            color: #666;
        }
        
        .login-link a {
            color: #ff441f;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .login-link a:hover {
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
            .register-container {
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
    <div class="register-container">
        <!-- Sección de ilustración -->
        <div class="illustration-section">
            <img src="https://cdn-icons-png.flaticon.com/512/3643/3643948.png" alt="Delivery Illustration" class="illustration-img">
            <h2 class="illustration-title">¡Únete a Home Delivery!</h2>
            <p class="illustration-text">Regístrate ahora y disfruta de envíos rápidos, descuentos exclusivos y seguimiento en tiempo real.</p>
        </div>

        
        
        <!-- Sección del formulario -->
        <div class="form-section">
            <h1 class="form-title">Crear Cuenta</h1>
            <p class="form-subtitle">Completa tus datos para comenzar</p>
            
            <form id="registerForm" method="POST" action="{{route('registro.store')}}">

                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input name="correo_electronico" type="email" id="email" class="form-input" placeholder="tucorreo@ejemplo.com" required>
                    <i class="fas fa-envelope input-icon"></i>
                    <div class="validation-message">Por favor ingresa un correo válido</div>
                </div>
                
                <div class="form-group">
                    <label for="name" class="form-label">Nombre completo del usuario</label>
                    <input name="nombre" type="text" id="name" class="form-input" placeholder="Juan Pérez" required>
                    <i class="fas fa-user input-icon"></i>
                    <div class="validation-message">El nombre debe tener al menos 3 caracteres</div>
                </div>
                
                <div class="form-group">
                    <label for="idNumber" class="form-label">Número de Identificación</label>
                    <input name="identificacion" type="text" id="idNumber" class="form-input" placeholder="1234567890" required>
                    <i class="fas fa-id-card input-icon"></i>
                    <div class="validation-message">Ingresa un número de identificación válido</div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input name="contrasena" type="password" id="password" class="form-input" placeholder="••••••••" required>
                    <i class="fas fa-lock input-icon"></i>
                    <div class="validation-message">La contraseña debe tener al menos 8 caracteres</div>
                </div>
                
                <div class="form-footer">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-user-plus"></i> Registrarse
                    </button>
                    <p class="login-link">¿Ya tienes una cuenta? <button type="submit" class="auth-btn login-btn">
                        <i class="fas fa-user-plus"></i> Iniciar sesión
                    </button></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Validación en tiempo real
        /* document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const inputs = document.querySelectorAll('.form-input');
            
            // Validación mientras escribe
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    validateInput(this);
                });
            }); */
            
            // Validación al enviar el formulario
            /* form.addEventListener('submit', function(e) {
                e.preventDefault();
                let isValid = true;
                
                inputs.forEach(input => {
                    if (!validateInput(input)) {
                        isValid = false;
                    }
                });
                
                if (isValid) {
                    // Simulación de envío exitoso
                    form.innerHTML = `
                        <div style="text-align: center; animation: fadeInUp 0.5s ease-out;">
                            <i class="fas fa-check-circle" style="font-size: 4rem; color: #4CAF50; margin-bottom: 20px;"></i>
                            <h2 style="color: #333; margin-bottom: 15px;">¡Registro exitoso!</h2>
                            <p style="color: #666; margin-bottom: 30px;">Gracias por registrarte en Home Delivery. Hemos enviado un correo de confirmación.</p>
                            <a href="ingreso.html" style="display: inline-block; padding: 12px 25px; background: #ff441f; color: white; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s;">
                                Continuar al inicio de sesión
                            </a>
                        </div>
                    `;
                }
            }); */
            
            // Función de validación
            /* function validateInput(input) {
                const formGroup = input.parentElement;
                let isValid = false;
                
                if (input.id === 'email') {
                    isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value.trim());
                } else if (input.id === 'name') {
                    isValid = input.value.trim().length >= 3;
                } else if (input.id === 'idNumber') {
                    isValid = /^\d{8,15}$/.test(input.value.trim());
                } else if (input.id === 'password') {
                    isValid = input.value.length >= 8;
                }
                
                if (input.value.trim() === '') {
                    formGroup.classList.remove('success');
                    formGroup.classList.remove('error');
                } else if (isValid) {
                    formGroup.classList.remove('error');
                    formGroup.classList.add('success');
                } else {
                    formGroup.classList.remove('success');
                    formGroup.classList.add('error');
                }
                
                return isValid;
            }
        }); */
    </script>
</body>
</html>