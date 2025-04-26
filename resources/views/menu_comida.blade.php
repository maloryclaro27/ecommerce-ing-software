<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - Home Delivery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        .menu-container {
            padding: 120px 5% 80px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .restaurant-section {
            margin-bottom: 60px;
        }
        .restaurant-title {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #ff441f;
            position: relative;
        }
        .restaurant-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: #ff441f;
        }
        .platos-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }
        .plato-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .plato-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .plato-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .plato-info {
            padding: 15px;
        }
        .plato-nombre {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .plato-precio {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 12px;
        }
        .plato-btn {
            display: inline-block;
            padding: 6px 16px;
            background: #ff441f;
            color: white;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background 0.3s;
        }
        .plato-btn:hover {
            background: #e03a1a;
        }
        @media (max-width: 768px) {
            .platos-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <!-- Burger King -->
        <section class="restaurant-section">
            <h2 class="restaurant-title">Burger King</h2>
            <div class="platos-list">
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?whopper" alt="Whopper" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Whopper</div>
                        <div class="plato-precio">$20.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?chicken,nuggets" alt="Nuggets" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Chicken Nuggets (10 pcs)</div>
                        <div class="plato-precio">$12.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?fries" alt="Papas fritas" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Papas Fritas</div>
                        <div class="plato-precio">$8.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?onion,rings" alt="Aros de cebolla" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Aros de Cebolla</div>
                        <div class="plato-precio">$9.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?soft,drink" alt="Bebida" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Bebida Gaseosa</div>
                        <div class="plato-precio">$5.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Wok -->
        <section class="restaurant-section">
            <h2 class="restaurant-title">Wok</h2>
            <div class="platos-list">
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?sushi" alt="Sushi Roll" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Sushi Roll (8 pcs)</div>
                        <div class="plato-precio">$25.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?chop,suey" alt="Chop Suey" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Chop Suey de Pollo</div>
                        <div class="plato-precio">$22.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?fried,rice" alt="Arroz Chaufa" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Arroz Chaufa</div>
                        <div class="plato-precio">$18.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?vegetables,stirfry" alt="Verduras salteadas" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Verduras Salteadas</div>
                        <div class="plato-precio">$16.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?spring,rolls" alt="Rollitos de primavera" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Rollitos Primavera (4 pcs)</div>
                        <div class="plato-precio">$14.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tijuana Tex-Mex -->
        <section class="restaurant-section">
            <h2 class="restaurant-title">Tijuana Tex-Mex</h2>
            <div class="platos-list">
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?tacos" alt="Tacos al Pastor" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Tacos al Pastor</div>
                        <div class="plato-precio">$20.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?burrito" alt="Burrito" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Burrito</div>
                        <div class="plato-precio">$22.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?quesadilla" alt="Quesadilla" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Quesadilla</div>
                        <div class="plato-precio">$18.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?nachos" alt="Nachos" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Nachos con Queso</div>
                        <div class="plato-precio">$19.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?fajitas" alt="Fajitas" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Fajitas de Pollo</div>
                        <div class="plato-precio">$24.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- McDonald's -->
        <section class="restaurant-section">
            <h2 class="restaurant-title">McDonald's</h2>
            <div class="platos-list">
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?big,mac" alt="Big Mac" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Big Mac</div>
                        <div class="plato-precio">$21.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?mcnuggets" alt="McNuggets" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">McNuggets (6 pcs)</div>
                        <div class="plato-precio">$13.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?cheeseburger" alt="Cheeseburger" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Cheeseburger</div>
                        <div class="plato-precio">$12.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?fries" alt="Papas Fritas" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Papas Fritas</div>
                        <div class="plato-precio">$8.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?milkshake" alt="Malteada" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Malteada</div>
                        <div class="plato-precio">$10.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Juan Valdéz -->
        <section class="restaurant-section">
            <h2 class="restaurant-title">Juan Valdéz</h2>
            <div class="platos-list">
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?espresso" alt="Espresso" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Espresso</div>
                        <div class="plato-precio">$6.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?latte" alt="Latte" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Latte</div>
                        <div class="plato-precio">$8.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?croissant" alt="Croissant" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Croissant</div>
                        <div class="plato-precio">$7.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?muffin" alt="Muffin" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Muffin</div>
                        <div class="plato-precio">$6.500</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?sandwich" alt="Sándwich" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Sándwich de Jamón y Queso</div>
                        <div class="plato-precio">$9.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Archies -->
        <section class="restaurant-section">
            <h2 class="restaurant-title">Archies</h2>
            <div class="platos-list">
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?pizza" alt="Pizza Margherita" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Pizza Margherita</div>
                        <div class="plato-precio">$28.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?lasagna" alt="Lasaña" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Lasaña</div>
                        <div class="plato-precio">$26.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?pasta" alt="Pasta Alfredo" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Pasta Alfredo</div>
                        <div class="plato-precio">$24.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?bruschetta" alt="Bruschetta" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Bruschetta</div>
                        <div class="plato-precio">$14.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
                <div class="plato-card">
                    <img src="https://source.unsplash.com/random/600x400/?tiramisu" alt="Tiramisú" class="plato-img">
                    <div class="plato-info">
                        <div class="plato-nombre">Tiramisú</div>
                        <div class="plato-precio">$16.000</div>
                        <a href="#" class="plato-btn">Agregar</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
