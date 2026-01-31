<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TifawinSouk - Votre marketplace locale')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
            text-decoration: none;
            color: white;
        }
        .nav {
            display: flex;
            gap: 2rem;
        }
        .nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            transition: all 0.3s;
        }
        .nav a:hover {
            background: rgba(255,255,255,0.2);
        }
        /* Container */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        /* Hero */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 4rem 2rem;
            margin-bottom: 3rem;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .hero p {
            font-size: 1.25rem;
            opacity: 0.9;
        }
        /* Grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        /* Card */
        .card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0,0,0,0.15);
        }
        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #ecf0f1;
        }
        .card-body {
            padding: 1.5rem;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }
        .card-text {
            color: #7f8c8d;
            margin-bottom: 1rem;
        }
        .card-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #27ae60;
        }
        .card-stock {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: #27ae60;
            color: white;
            border-radius: 12px;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        .card-stock.out-of-stock {
            background: #e74c3c;
        }
        /* Badge */
        .badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #3498db;
            color: white;
            border-radius: 20px;
            font-size: 0.875rem;
        }
        /* Breadcrumb */
        .breadcrumb {
            margin-bottom: 2rem;
            color: #7f8c8d;
        }
        .breadcrumb a {
            color: #3498db;
            text-decoration: none;
        }
        /* Product Detail */
        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .product-image {
            width: 100%;
            border-radius: 8px;
        }
        .product-info h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        .product-price {
            font-size: 2.5rem;
            font-weight: bold;
            color: #27ae60;
            margin: 1rem 0;
        }
        .product-description {
            line-height: 1.8;
            color: #555;
            margin-top: 1.5rem;
        }
        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 4rem;
        }
        /* Section Title */
        .section-title {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #2c3e50;
            text-align: center;
        }
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }
        .pagination a,
        .pagination span {
            padding: 0.5rem 1rem;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
        }
        .pagination a:hover {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }
        .pagination .active {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <a href="{{ route('home') }}" class="logo">🛍️ TifawinSouk</a>
            <nav class="nav">
                <a href="{{ route('home') }}">Accueil</a>
                <a href="{{ route('public.categories') }}">Catégories</a>
                <a href="{{ route('admin.categories.index') }}">Admin</a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 TifawinSouk - Votre marketplace locale marocaine</p>
    </div>
</body>
</html>