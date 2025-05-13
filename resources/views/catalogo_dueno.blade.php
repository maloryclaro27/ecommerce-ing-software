@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    /* Estilos base consistentes */
    .catalog-container {
        padding: 100px 5% 80px;
        max-width: 1200px;
        margin: 0 auto;
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
    
    /* Header del negocio */
    .business-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }
    
    .business-name {
        font-size: 2rem;
        color: #ff441f;
        font-weight: 700;
    }
    
    /* Contenedor de productos */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }
    
    /* Tarjeta de producto */
    .product-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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
        top: 10px;
        right: 10px;
        display: flex;
        gap: 10px;
    }
    
    .edit-btn, .delete-btn {
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
    }
    
    .edit-btn {
        background-color: #ff441f;
    }
    
    .delete-btn {
        background-color: #ff1f1f;
    }
    
    .edit-btn:hover, .delete-btn:hover {
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
    }
    
    .product-price {
        font-size: 1.3rem;
        font-weight: bold;
        color: #ff441f;
    }
    
    /* Modal de edición */
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
    }
    
    .modal-overlay.active .modal-content {
        transform: translateY(0);
    }
    
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
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
    }
    
    /* Formulario de edición */
    .form-group {
        margin-bottom: 20px;
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
    }
    
    .image-preview {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
        display: none;
    }
    
    /* Botones de acción */
    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }
    
    .btn {
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
    }
    
    .btn-primary {
        background-color: #ff441f;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #e03a1a;
        transform: translateY(-2px);
    }
    
    .btn-secondary {
        background-color: white;
        color: #ff441f;
        border: 2px solid #ff441f;
    }
    
    .btn-secondary:hover {
        background-color: #fff8f6;
    }
    
    /* Botón añadir producto */
    .add-product-btn {
        background-color: #ff441f;
        color: white;
        padding: 12px 25px;
        border-radius: 30px;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .add-product-btn:hover {
        background-color: #e03a1a;
        transform: translateY(-2px);
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
</style>

<div class="catalog-container">
    <div class="business-header">
        <h1 class="business-name">{{ $business->name }}</h1>
        <div>
            <button class="add-product-btn" id="addProductBtn">
                <i class="fas fa-plus"></i> Añadir Producto
            </button>
            <a href="{{ route('catalogo') }}" class="btn-secondary" style="margin-left: 15px;">
                <i class="fas fa-eye"></i> Ver Catálogo Público
            </a>
        </div>
    </div>
    
    <h2 class="section-title">Administrar Catálogo</h2>
    
    @if($products->isEmpty())
        <div style="text-align: center; padding: 50px 0;">
            <i class="fas fa-box-open" style="font-size: 3rem; color: #ccc; margin-bottom: 20px;"></i>
            <h3 style="color: #666;">No hay productos en tu catálogo</h3>
            <p style="color: #999;">Comienza añadiendo tu primer producto</p>
        </div>
    @else
        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-card" data-id="{{ $product->id }}">
                    <div class="product-image-container">
                        <img src="{{ asset($product->imagen) }}" alt="{{ $product->nombre }}" class="product-image">
                        <div class="product-actions">
                            <button class="edit-btn" onclick="openEditModal({{ $product->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete-btn" onclick="confirmDelete({{ $product->id }})">
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
                <label for="productName" class="form-label">Nombre</label>
                <input type="text" id="productName" name="nombre" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="productDescription" class="form-label">Descripción</label>
                <textarea id="productDescription" name="descripcion" class="form-control" rows="3"></textarea>
            </div>
            
            <div class="form-group">
                <label for="productPrice" class="form-label">Precio</label>
                <input type="number" id="productPrice" name="precio" class="form-control" step="0.01" min="0" required>
            </div>
            
            <div class="form-group">
                <label for="productImage" class="form-label">Imagen</label>
                <input type="file" id="productImage" name="imagen" class="form-control" accept="image/*">
                <img id="imagePreview" class="image-preview" src="" alt="Vista previa">
            </div>
            
            <div class="action-buttons">
                <button type="button" class="btn-secondary" onclick="closeModal()">
                    Cancelar
                </button>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Toast de éxito -->
<div class="success-toast" id="successToast">
    <i class="fas fa-check-circle"></i>
    <span>¡Guardado exitosamente!</span>
</div>

<script>
    let currentProductId = null;
    const businessId = {{ $business->id }};

    document.getElementById('addProductBtn').addEventListener('click', () => {
        document.getElementById('modalTitle').textContent = 'Añadir Nuevo Producto';
        document.getElementById('productId').value = '';
        document.getElementById('productForm').reset();
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('productModal').classList.add('active');
    });

    function openEditModal(productId) {
        currentProductId = productId;
        const card = document.querySelector(`.product-card[data-id="${productId}"]`);
        const nombre = card.querySelector('.product-name').textContent;
        const descripcion = card.querySelector('.product-description').textContent;
        const precio = parseFloat(card.querySelector('.product-price').textContent.replace(/[^0-9,]/g, '').replace(',', '.'));

        document.getElementById('modalTitle').textContent = 'Editar Producto';
        document.getElementById('productId').value = productId;
        document.getElementById('productName').value = nombre;
        document.getElementById('productDescription').value = descripcion;
        document.getElementById('productPrice').value = precio;

        const imageSrc = card.querySelector('.product-image').src;
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = imageSrc;
        imagePreview.style.display = 'block';

        document.getElementById('productModal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('productModal').classList.remove('active');
    }

    document.getElementById('productImage').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = event.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('productForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('business_id', businessId);

        const url = currentProductId ? `/business/${businessId}/products/${currentProductId}` : `/business/${businessId}/products`;
        const method = currentProductId ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccessToast();
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    function confirmDelete(productId) {
        if (confirm('¿Estás seguro de eliminar este producto?')) {
            fetch(`/business/${businessId}/products/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
        }
    }

    function showSuccessToast() {
        const toast = document.getElementById('successToast');
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }
</script>
@endsection
