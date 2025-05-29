@extends('layouts.app')

@section('content')
<style>
    /* Estilos consistentes con carrito */
    .delivery-container {
        padding: 100px 5% 80px;
        max-width: 800px;
        margin: 0 auto;
        min-height: calc(100vh - 70px);
    }

    .section-title {
        font-size: 2.5rem;
        margin-bottom: 30px;
        color: #333;
        text-align: center;
        position: relative;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background-color: #ff441f;
    }

    .delivery-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #ff441f;
        box-shadow: 0 0 0 3px rgba(255, 68, 31, 0.2);
        outline: none;
    }

    .dimensions-container {
        display: flex;
        gap: 15px;
    }

    .dimension-input {
        flex: 1;
    }

    .alert-warning {
        background-color: #fff8f6;
        border-left: 4px solid #ff441f;
        padding: 15px;
        margin: 20px 0;
        border-radius: 0 8px 8px 0;
        display: none;
    }

    /* Botones de acción: estilos tomados del blade de carrito */
    .continue-btn {
        padding: 10px 20px;
        background-color: white;
        color: #ff441f;
        border: 2px solid #ff441f;
        border-radius: 30px;
        font-weight: bold;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .continue-btn:hover {
        background-color: #ff441f;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 68, 31, 0.3);
    }

    .checkout-btn {
        padding: 10px 20px;
        background-color: #ff441f;
        color: white;
        border: 2px solid #ff441f;
        border-radius: 30px;
        font-weight: bold;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .checkout-btn:hover {
        background-color: #e03a1a;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 68, 31, 0.3);
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    @media (max-width: 768px) {
        .dimensions-container {
            flex-direction: column;
            gap: 15px;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 15px;
        }
        
        .continue-btn,
        .checkout-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="delivery-container">
    <h1 class="section-title">Domicilios Programados</h1>
    
    <form id="scheduledDeliveryForm" action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="delivery-card">
            <p style="margin-bottom: 25px; color: #666; text-align: center;">
                Programa la recogida y entrega de tus paquetes mediante nuestro servicio de drones.
                <br>Máximo: 2.5kg | Dimensiones: 40x30x30cm
            </p>
            
            <h3 style="color: #ff441f; margin-bottom: 20px;">Información del paquete</h3>
            
            <div class="form-group">
                <label class="form-label">Peso del paquete (kg)</label>
                <input type="number" step="0.1" class="form-control" id="packageWeight" name="weight" min="0.1" max="2.5" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Dimensiones del paquete (cm)</label>
                <div class="dimensions-container">
                    <div class="dimension-input">
                        <input type="number" class="form-control" id="packageLength" name="length" placeholder="Largo" min="1" max="40" required>
                    </div>
                    <div class="dimension-input">
                        <input type="number" class="form-control" id="packageWidth" name="width" placeholder="Ancho" min="1" max="30" required>
                    </div>
                    <div class="dimension-input">
                        <input type="number" class="form-control" id="packageHeight" name="height" placeholder="Alto" min="1" max="30" required>
                    </div>
                </div>
            </div>
            
            <div id="sizeWarning" class="alert-warning">
                <strong>¡Atención!</strong> Las dimensiones o peso exceden la capacidad del dron. Por favor ajusta los valores.
            </div>
            
            <h3 style="color: #ff441f; margin-bottom: 20px; margin-top: 30px;">Direcciones</h3>
            
            <div class="form-group">
                <label class="form-label">Dirección de recogida</label>
                <input type="text" class="form-control" id="pickupAddress" name="pickup_address" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Dirección de entrega</label>
                <input type="text" class="form-control" id="deliveryAddress" name="delivery_address" required>
            </div>
            
            <h3 style="color: #ff441f; margin-bottom: 20px; margin-top: 30px;">Fecha y hora</h3>
            
            <div class="form-group">
                <label class="form-label">Fecha de recogida</label>
                <input type="date" class="form-control" id="deliveryDate" name="delivery_date" min="{{ date('Y-m-d') }}" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Hora de recogida (8:00 am - 6:00 pm)</label>
                <input type="time" class="form-control" id="deliveryTime" name="delivery_time" min="08:00" max="18:00" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Instrucciones adicionales (opcional)</label>
                <textarea class="form-control" id="deliveryNotes" name="notes" rows="3"></textarea>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ url()->previous() }}" class="continue-btn">
                Cancelar
            </a>
            <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST" class="hidden">
              @csrf
            </form>
            <button onclick="document.getElementById('checkout-form').submit()"
                    class="checkout-btn">
              Realizar pago
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('scheduledDeliveryForm');
        const weightInput = document.getElementById('packageWeight');
        const lengthInput = document.getElementById('packageLength');
        const widthInput = document.getElementById('packageWidth');
        const heightInput = document.getElementById('packageHeight');
        const warningDiv = document.getElementById('sizeWarning');
        const submitBtn = document.getElementById('submitBtn');
        
        // Validar dimensiones en tiempo real
        function validateDimensions() {
            const weight = parseFloat(weightInput.value) || 0;
            const length = parseInt(lengthInput.value) || 0;
            const width = parseInt(widthInput.value) || 0;
            const height = parseInt(heightInput.value) || 0;
            
            const exceedsWeight = weight > 2.5;
            const exceedsLength = length > 40;
            const exceedsWidth = width > 30;
            const exceedsHeight = height > 30;
            
            if (exceedsWeight || exceedsLength || exceedsWidth || exceedsHeight) {
                warningDiv.style.display = 'block';
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.6';
                submitBtn.style.cursor = 'not-allowed';
                return false;
            } else {
                warningDiv.style.display = 'none';
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
                return true;
            }
        }
        
        // Event listeners para validación
        weightInput.addEventListener('input', validateDimensions);
        lengthInput.addEventListener('input', validateDimensions);
        widthInput.addEventListener('input', validateDimensions);
        heightInput.addEventListener('input', validateDimensions);
        
        // Validar al enviar el formulario
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateDimensions()) {
                alert('Domicilio programado correctamente. Nos pondremos en contacto para confirmar los detalles.');
                // Descomenta la siguiente línea para enviar realmente:
                // form.submit();
            }
        });
        
        // Establecer fecha mínima como hoy
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('deliveryDate').min = today;
    });
</script>
@endsection
