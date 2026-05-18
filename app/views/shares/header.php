<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore - Quản lý sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body {
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            min-height: 100vh;
        }

        /* === TOP BAR === */
        .top-bar {
            background: linear-gradient(90deg, #ff416c 0%, #ff4b2b 100%);
            padding: 12px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .top-logo {
            color: white;
            font-size: 1.5rem;
            font-weight: 800;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .top-logo i {
            font-size: 1.8rem;
        }
        .menu-categories {
            background: rgba(255,255,255,0.15);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .menu-categories:hover {
            background: rgba(255,255,255,0.25);
        }

        /* Search Bar */
        .search-box {
            flex: 1;
            max-width: 600px;
            margin: 0 20px;
        }
        .search-input-group {
            position: relative;
        }
        .search-input {
            width: 100%;
            padding: 10px 50px 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            outline: none;
        }
        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: #ff416c;
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .search-btn:hover {
            background: #ff4b2b;
        }

        /* Top Bar Right */
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }
        .top-item {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            transition: all 0.3s;
            padding: 5px 10px;
            border-radius: 6px;
        }
        .top-item:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-2px);
        }
        .top-item i {
            font-size: 1.1rem;
        }
        .top-item .label {
            display: flex;
            flex-direction: column;
        }
        .top-item .label .small {
            font-size: 0.75rem;
            opacity: 0.9;
        }
        .top-item .label .main {
            font-weight: 600;
            font-size: 0.9rem;
        }
        .cart-badge {
            background: #ffd700;
            color: #ff416c;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.7rem;
            font-weight: 700;
            position: absolute;
            top: -5px;
            right: -5px;
        }
        .cart-wrapper {
            position: relative;
        }
        .btn-login {
            background: rgba(255,255,255,0.2);
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            border: 2px solid rgba(255,255,255,0.3);
        }
        .btn-login:hover {
            background: white;
            color: #ff416c;
        }

        /* === NAVBAR === */
        .navbar {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 15px 0;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            color: #fff !important;
            font-size: 1.7rem;
            text-decoration: none;
        }
        .brand-text {
            background: linear-gradient(90deg, #667eea, #00d2ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }
        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s;
        }
        .nav-link:hover {
            color: #00d2ff !important;
        }

        /* === BANNER SIDEBAR === */
        .sidebar-banner {
            position: sticky;
            top: 100px;
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            color: white;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s ease;
        }
        .sidebar-banner:hover {
            transform: translateY(-5px);
        }
        .banner-apple {
            background: linear-gradient(180deg, #1d1d1f 0%, #2d2d30 100%);
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }
        .banner-android {
            background: linear-gradient(180deg, #3DDC84 0%, #079455 100%);
            border: 2px solid rgba(255,255,255,0.15);
            box-shadow: 0 20px 40px rgba(61,220,132,0.3);
        }
        .banner-icon {
            font-size: 4rem;
            margin-bottom: 15px;
        }
        .banner-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .banner-subtitle {
            font-size: 0.85rem;
            opacity: 0.8;
            margin-bottom: 20px;
        }
        .badge-new {
            background: rgba(255,255,255,0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 15px;
        }
        .banner-price {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 10px;
        }
        .banner-features {
            list-style: none;
            padding: 0;
            margin: 15px 0;
            text-align: left;
        }
        .banner-features li {
            font-size: 0.8rem;
            padding: 4px 0;
            opacity: 0.9;
        }
        .banner-features li i {
            margin-right: 8px;
        }

        /* === MAIN CONTENT === */
        .main-container {
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            min-height: 600px;
        }
        .page-title {
            color: #1d1d1f;
            font-weight: 700;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #667eea;
            display: inline-block;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }
        .btn-success {
            background: linear-gradient(135deg, #3DDC84 0%, #079455 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(61, 220, 132, 0.4);
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 12px 20px;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .form-group label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
        }

        /* === RESPONSIVE === */
        @media (max-width: 1200px) {
            .sidebar-banner {
                display: none;
            }
        }
        @media (max-width: 992px) {
            .top-bar-right .top-item .label {
                display: none;
            }
            .search-box {
                margin: 10px 0 0 0;
                max-width: 100%;
            }
            .top-bar-left, .top-bar-right {
                justify-content: center;
            }
            .top-bar {
                text-align: center;
            }
        }
        @media (max-width: 768px) {
            .top-bar {
                padding: 8px 0;
            }
            .menu-categories span {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- TOP BAR -->
    <div class="top-bar">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <!-- Left -->
                <div class="top-bar-left">
                    <a href="/webbanhang/public/Product" class="top-logo">
                        <i class="fas fa-cat"></i>
                        TECHSTORE
                    </a>
                    <button class="menu-categories">
                        <i class="fas fa-bars"></i>
                        <span>Danh mục</span>
                    </button>
                </div>

                <!-- Search -->
                <div class="search-box d-none d-md-block">
                    <div class="search-input-group">
                        <input type="text" class="search-input" placeholder="Bạn cần tìm gì?">
                        <button class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Right -->
                <div class="top-bar-right">
                    <a href="tel:19005301" class="top-item">
                        <i class="fas fa-headset"></i>
                        <div class="label">
                            <span class="small">Hotline</span>
                            <span class="main">1900.5301</span>
                        </div>
                    </a>
                    <a href="#" class="top-item">
                        <i class="fas fa-store"></i>
                        <div class="label">
                            <span class="small">Hệ thống</span>
                            <span class="main">Showroom</span>
                        </div>
                    </a>
                    <a href="#" class="top-item">
                        <i class="fas fa-clipboard-list"></i>
                        <div class="label">
                            <span class="small">Tra cứu</span>
                            <span class="main">đơn hàng</span>
                        </div>
                    </a>
                    <a href="#" class="top-item cart-wrapper">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-badge">0</span>
                        <div class="label">
                            <span class="main">Giỏ hàng</span>
                        </div>
                    </a>
                    <a href="#" class="top-item btn-login">
                        <i class="fas fa-user"></i>
                        <span>Đăng nhập</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Search -->
            <div class="search-box d-md-none mt-2">
                <div class="search-input-group">
                    <input type="text" class="search-input" placeholder="Bạn cần tìm gì?">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="/webbanhang/public/Product">
                <i class="fas fa-cat" style="font-size: 1.8rem;"></i>
                <span class="brand-text">TechStore</span>
                <i class="fas fa-battery-full" style="color: #3DDC84;"></i>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/public/Product">
                            <i class="fas fa-list"></i> Danh sách sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/public/Product/add">
                            <i class="fas fa-plus-circle"></i> Thêm sản phẩm
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid px-4 py-4">
        <div class="row">
            <!-- Banner trái - Apple -->
            <div class="col-xl-2 d-none d-xl-block">
                <div class="sidebar-banner banner-apple">
                    <div class="badge-new">Mới ra mắt</div>
                    <i class="fab fa-apple banner-icon"></i>
                    <div class="banner-title">iPhone 16 Pro Max</div>
                    <div class="banner-subtitle">Titan - Chip A18 Pro</div>
                    <ul class="banner-features">
                        <li><i class="fas fa-check" style="color:#3DDC84"></i> Camera 48MP</li>
                        <li><i class="fas fa-check" style="color:#3DDC84"></i> Titanium Design</li>
                        <li><i class="fas fa-check" style="color:#3DDC84"></i> Action Button</li>
                        <li><i class="fas fa-check" style="color:#3DDC84"></i> USB-C</li>
                    </ul>
                    <div class="banner-price">Từ 29.990.000₫</div>
                </div>
            </div>

            <!-- Nội dung chính -->
            <div class="col-12 col-xl-8">
                <div class="main-container">