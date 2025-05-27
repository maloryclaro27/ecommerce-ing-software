@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    /* Estilos base consistentes */
    .catalog-container {
        padding: 80px 5% 60px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    /* Header mejorado */
    .business-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .business-name {
        font-size: 2.2rem;
        color: #ff441f;
        font-weight: 700;
        margin-bottom: 10px;
        position: relative;
        display: inline-block;
    }
    
    .business-name::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: #ff441f;
    }
    
    .business-subtitle {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 30px;
    }
    
    /* Controles de acción */
    .action-controls {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }
    
    .action-btn {
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: bold;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s;
        text-decoration: none;
        font-size: 0.95rem;
    }
    
    .primary-btn {
        background-color: #ff441f;
        color: white;
        border: 2px solid #ff441f;
    }
    
    .primary-btn:hover {
        background-color: #e03a1a;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 68, 31, 0.2);
    }
    
    .secondary-btn {
        background-color: white;
        color: #ff441f;
        border: 2px solid #ff441f;
    }
    
    .secondary-btn:hover {
        background-color: #fff8f6;
        transform: translateY(-2px);
    }
    
    /* Contenedor de productos */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
        margin-top: 20px;
    }
    
    /* Tarjeta de producto mejorada */
    .product-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
        border: 1px solid #f0f0f0;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-color: #ffd6cc;
    }
    
    .product-image-container {
        height: 200px;
        overflow: hidden;
        position: relative;
    }
    
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    
    .product-card:hover .product-image {
        transform: scale(1.05);
    }
    
    .product-actions {
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
        gap: 10px;
    }
    
    .action-icon {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
        font-size: 0.9rem;
    }
    
    .edit-btn {
        background-color: rgba(255, 68, 31, 0.9);
    }
    
    .delete-btn {
        background-color: rgba(255, 31, 31, 0.9);
    }
    
    .action-icon:hover {
        transform: scale(1.1);
    }
    
    /* Contenido de la tarjeta */
    .product-content {
        padding: 20px;
    }
    
    .product-name {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }
    
    .product-description {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 15px;
        min-height: 60px;
        line-height: 1.5;
    }
    
    .product-price {
        font-size: 1.3rem;
        font-weight: bold;
        color: #ff441f;
        margin-top: 10px;
    }
    
    /* Estado vacío */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-top: 30px;
    }
    
    .empty-icon {
        font-size: 3.5rem;
        color: #ccc;
        margin-bottom: 20px;
    }
    
    .empty-title {
        font-size: 1.5rem;
        color: #666;
        margin-bottom: 15px;
    }
    
    .empty-text {
        color: #999;
        margin-bottom: 25px;
        font-size: 1rem;
    }
    
    /* Modal mejorado */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
    }
    
    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    
    .modal-content {
        background: white;
        border-radius: 15px;
        width: 90%;
        max-width: 500px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transform: translateY(20px);
        transition: all 0.3s;
        max-height: 90vh;
        overflow-y: auto;
    }
    
    .modal-overlay.active .modal-content {
        transform: translateY(0);
    }
    
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    
    .modal-title {
        font-size: 1.5rem;
        color: #333;
        font-weight: 600;
    }
    
    .close-modal {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #666;
        transition: all 0.3s;
    }
    
    .close-modal:hover {
        color: #ff441f;
        transform: rotate(90deg);
    }
    
    /* Formulario mejorado */
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 0.95rem;
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
        box-shadow: 0 0 0 3px rgba(255, 68, 31, 0.1);
        outline: none;
    }
    
    .image-preview-container {
        margin-bottom: 15px;
        text-align: center;
    }
    
    .image-preview {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
        display: none;
        margin: 0 auto;
        border: 1px solid #eee;
    }
    
    /* Botones del modal */
    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
    }
    
    /* Toast de éxito */
    .success-toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #4BB543;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 10px;
        z-index: 1000;
        transform: translateY(100px);
        opacity: 0;
        transition: all 0.3s;
    }
    
    .success-toast.show {
        transform: translateY(0);
        opacity: 1;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .business-name {
            font-size: 1.8rem;
        }
        
        .action-controls {
            flex-direction: column;
            align-items: center;
        }
        
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        }
        
        .modal-content {
            padding: 20px;
        }
    }
</style>

<div class="catalog-container">
    <!-- Encabezado del negocio -->
    <div class="business-header">
        <h1 class="business-name">{{ $business->name }}</h1>
        <p class="business-subtitle">Administración de catálogo</p>
    </div>
    
    <!-- Controles de acción -->
    <div class="action-controls">
        <a href="{{ route('catalogo') }}" class="action-btn secondary-btn">
            <i class="fas fa-eye"></i> Ver Catálogo Público
        </a>
        <button class="action-btn primary-btn" id="addProductBtn">
            <i class="fas fa-plus"></i> Añadir Producto
        </button>
    </div>
    
    <!-- Listado de productos -->
    @if($products->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <h3 class="empty-title">Tu catálogo está vacío</h3>
            <p class="empty-text">Comienza añadiendo productos para que aparezcan aquí</p>
            <button class="action-btn primary-btn" id="addFirstProductBtn">
                <i class="fas fa-plus"></i> Añadir primer producto
            </button>
        </div>
    @else
        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-card" data-id="{{ $product->id }}">
                    <div class="product-image-container">
                        <img src="{{ asset($product->imagen) }}" alt="{{ $product->nombre }}" class="product-image">
                        <div class="product-actions">
                            <button class="action-icon edit-btn" onclick="openEditModal({{ $product->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-icon delete-btn" onclick="confirmDelete({{ $product->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3 class="product-name">{{ $product->nombre }}</h3>
                        <p class="product-description">{{ $product->descripcion }}</p>
                        <p class="product-price">${{ number_format($product->precio, 2, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Modal para añadir/editar producto -->
<div class="modal-overlay" id="productModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modalTitle">Añadir Nuevo Producto</h3>
            <button class="close-modal" onclick="closeModal()">&times;</button>
        </div>
        
        <form id="productForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="productId" name="id" value="">
            
            <div class="form-group">
                <label for="productName" class="form-label">Nombre del producto</label>
                <input type="text" id="productName" name="nombre" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="productDescription" class="form-label">Descripción</label>
                <textarea id="productDescription" name="descripcion" class="form-control" rows="4" placeholder="Describe tu producto..."></textarea>
            </div>
            
            <div class="form-group">
                <label for="productPrice" class="form-label">Precio ($)</label>
                <input type="number" id="productPrice" name="precio" class="form-control" step="0.01" min="0" placeholder="0.00" required>
            </div>
            
            <div class="form-group">
                <label for="productImage" class="form-label">Imagen del producto</label>
                <input type="file" id="productImage" name="imagen" class="form-control" accept="image/*">
                <div class="image-preview-container">
                    <img id="imagePreview" class="image-preview" src="" alt="Vista previa de imagen">
                </div>
            </div>
            
            <div class="modal-actions">
                <button type="button" class="action-btn secondary-btn" onclick="closeModal()">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button type="submit" class="action-btn primary-btn">
                    <i class="fas fa-save"></i> Guardar Producto
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Toast de éxito -->
<div class="success-toast" id="successToast">
    <i class="fas fa-check-circle"></i>
    <span>¡Cambios guardados exitosamente!</span>
</div>

<script>
    console.log('JS cargado');

    let currentProductId = null;
    const businessId = {{ $business->id }};

    const addProductBtn      = document.getElementById('addProductBtn');
    const addFirstProductBtn = document.getElementById('addFirstProductBtn');
    const productModal       = document.getElementById('productModal');
    const productForm        = document.getElementById('productForm');
    const imageInput         = document.getElementById('productImage');
    const imagePreview       = document.getElementById('imagePreview');
    const successToast       = document.getElementById('successToast');

    // Listeners
    addProductBtn?.addEventListener('click', openAddModal);
    addFirstProductBtn?.addEventListener('click', openAddModal);
    productForm?.addEventListener('submit', handleSubmit);
    imageInput?.addEventListener('change', handleImagePreview);

    // Funciones
    function openAddModal() {
        document.getElementById('modalTitle').textContent = 'Añadir Nuevo Producto';
        document.getElementById('productId').value = '';
        productForm.reset();
        imagePreview.style.display = 'none';
        productModal.classList.add('active');
    }

    function handleImagePreview(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = evt => {
            imagePreview.src = evt.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    function handleSubmit(e) {
        e.preventDefault();
        const formData = new FormData(productForm);
        formData.append('business_id', businessId);

        const url    = currentProductId 
                       ? `/business/${businessId}/products/${currentProductId}`
                       : `/business/${businessId}/products`;
        const method = currentProductId ? 'PUT' : 'POST';

        fetch(url, {
            method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                successToast.querySelector('span').textContent = '¡Guardado exitosamente!';
                successToast.classList.add('show');
                setTimeout(()=> location.reload(), 1500);
            } else {
                console.error('Respuesta sin éxito:', data);
            }
        })
        .catch(err => {
            console.error('Error en fetch:', err);
            alert('Ocurrió un error. Revisa la consola.');
        });
    }

    window.openEditModal = function(id) { /* …igual que antes…*/ };
    window.confirmDelete  = function(id) { /* …igual que antes…*/ };
    function closeModal() { productModal.classList.remove('active'); }
</script>
