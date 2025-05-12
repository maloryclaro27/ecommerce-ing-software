@extends('layouts.app')

@section('content')

<style>
    /* Estilo del contenedor principal */
    .cart-container {
        padding: 100px 5% 80px; /* Compensa navbar fijo */
        max-width: 1200px;
        margin: 0 auto;
        min-height: calc(100vh - 70px);
    }

    /* Título estilo Home Delivery */
    .section-title {
        font-size: 2.5rem;
        margin-bottom: 50px;
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

    /* Estilo de las cards de producto */
    .cart-items-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .cart-item {
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #f0f0f0;
        transition: all 0.3s ease;
        position: relative;
    }

    .cart-item:hover {
        background-color: #fff8f6;
        transform: translateX(5px);
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 20px;
        flex: 1;
    }

    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #eee;
    }

    .product-details h3 {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .product-details p {
        color: #666;
        font-size: 0.95rem;
    }

    .price-info {
        text-align: right;
        min-width: 150px;
    }

    .item-total {
        font-size: 1.1rem;
        font-weight: bold;
        color: #ff441f;
    }

    .unit-price {
        font-size: 0.9rem;
        color: #888;
    }

    /* Botón de eliminar */
    .remove-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 30px;
        height: 30px;
        background-color: #ff441f;
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        transition: all 0.3s;
        transform: scale(0.8);
    }

    .cart-item:hover .remove-btn {
        opacity: 1;
        transform: scale(1);
    }

    .remove-btn:hover {
        background-color: #e03a1a;
    }

    /* Sección de total */
    .cart-summary {
        background-color: #fff8f6;
        padding: 25px;
        border-top: 2px solid #ff441f;
    }

    .total-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .total-label {
        font-size: 1.3rem;
        font-weight: bold;
        color: #333;
    }

    .total-amount {
        font-size: 1.8rem;
        font-weight: bold;
        color: #ff441f;
    }

    /* Botones de acción */
    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
    }

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

    /* Carrito vacío */
    .empty-cart {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-cart-icon {
        font-size: 5rem;
        color: #ff441f;
        margin-bottom: 20px;
    }

    .empty-cart h2 {
        font-size: 1.8rem;
        color: #333;
        margin-bottom: 15px;
    }

    .empty-cart p {
        color: #666;
        margin-bottom: 25px;
        font-size: 1.1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .cart-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .product-info {
            width: 100%;
        }

        .price-info {
            text-align: left;
            width: 100%;
            padding-left: 100px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .continue-btn, .checkout-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="cart-container">
    <h1 class="section-title">Tu Carrito de Compras</h1>
  
    @if($items->isNotEmpty())
      <div class="cart-items-container">
        <div class="cart-items-list">
          @foreach($items as $item)
            <div class="cart-item" data-id="{{ $item->id }}">
              <div class="product-info">
                <img
                  src="{{ asset($item->producto->imagen) }}"
                  alt="{{ $item->producto->nombre }}"
                  class="product-image"
                >
                <div class="product-details">
                  <h3>{{ $item->producto->nombre }}</h3>
                  <p>Cantidad: {{ $item->cantidad }}</p>
                </div>
              </div>
  
              <div class="price-info">
                <p class="item-total">
                  ${{ number_format($item->producto->precio * $item->cantidad, 2, ',', '.') }}
                </p>
                <p class="unit-price">
                  ${{ number_format($item->producto->precio, 2, ',', '.') }} c/u
                </p>
              </div>
  
              <button
                class="remove-btn"
                onclick="removeItem({{ $item->id }})"
                title="Eliminar una unidad"
              >
                &minus;
              </button>
            </div>
          @endforeach
        </div>
  
        <div class="cart-summary">
          <div class="total-container">
            <h3 class="total-label">Total</h3>
            <p class="total-amount">
              ${{ number_format($total, 2, ',', '.') }}
            </p>
          </div>
  
          <div class="action-buttons">
            <a href="{{ url()->previous() }}" class="continue-btn">
              Seguir comprando
            </a>
  
            <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST" class="hidden">
              @csrf
            </form>
            <button onclick="document.getElementById('checkout-form').submit()"
                    class="checkout-btn">
              Realizar pago
            </button>
          </div>
        </div>
      </div>
    @else
      <div class="empty-cart">
        <div class="empty-cart-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <h2>Tu carrito está vacío</h2>
        <p>Parece que no has agregado ningún producto aún</p>
        <div style="margin-top: 20px;">
            <a href="{{ url()->previous() }}" class="continue-btn">
                Seguir comprando
            </a>
        </div>
      </div>
    @endif
</div>
@endsection
  
@push('scripts')
<script>
    // Base URL para DELETE
    const deleteUrlBase = "{{ url('cart') }}/";
    const csrfToken      = document.querySelector('meta[name="csrf-token"]').content;
  
    function removeItem(itemId) {
        if (!confirm('¿Seguro que quieres eliminar una unidad de este producto?')) return;
    
        fetch(deleteUrlBase + itemId, {
            method: 'DELETE',
            credentials: 'same-origin',
            headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept':       'application/json'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Error en la petición');
            return res;
        })
        .then(() => {
            window.location.reload();
        })
        .catch(err => {
            console.error(err);
            alert('No se pudo eliminar el producto. Intenta de nuevo.');
        });
    }
</script>
@endpush