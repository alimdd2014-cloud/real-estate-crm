<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكتب الأمين للعقارات</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ===== الألوان الجديدة ===== */
        :root {
            --primary-dark: #0a1628;
            --gold: #c9a84c;
            --gold-dark: #b8973a;
            --light-bg: #f0f2f5;
            --text-dark: #1a1a2e;
            --text-gray: #6c757d;
            --white: #ffffff;
            --shadow: 0 4px 20px rgba(0,0,0,0.06);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Tajawal', sans-serif;
            background: var(--light-bg);
            color: var(--text-dark);
        }

        .container { max-width: 1200px; margin: auto; padding: 0 20px; }

        /* ===== الهيدر ===== */
        .header {
            background: var(--primary-dark);
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: var(--gold);
        }
        .logo span { color: white; }
        .logo i { margin-left: 10px; }
        .nav a {
            color: #ddd;
            text-decoration: none;
            margin: 0 12px;
            font-size: 15px;
            transition: 0.3s;
        }
        .nav a:hover { color: var(--gold); }

        /* ===== الهيرو ===== */
        .hero {
            background: linear-gradient(135deg, var(--primary-dark), #1a2a4a);
            color: white;
            padding: 80px 0 60px;
            text-align: center;
        }
        .hero h1 {
            font-size: 42px;
            margin-bottom: 15px;
        }
        .hero h1 i { color: var(--gold); margin-left: 10px; }
        .hero h1 .highlight { color: var(--gold); }
        .hero p {
            font-size: 18px;
            opacity: 0.8;
            max-width: 600px;
            margin: 0 auto 30px;
        }
        .hero .btn {
            display: inline-block;
            background: var(--gold);
            color: var(--primary-dark);
            padding: 14px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            transition: 0.3s;
            box-shadow: 0 4px 20px rgba(201, 168, 76, 0.4);
        }
        .hero .btn:hover {
            background: var(--gold-dark);
            transform: scale(1.05);
        }

        /* ===== معلومات المكتب ===== */
        .office-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            background: var(--white);
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            margin-top: -30px;
            position: relative;
            z-index: 10;
        }
        .office-info .item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 16px;
            color: var(--text-dark);
        }
        .office-info .item i {
            font-size: 22px;
            color: var(--gold);
            width: 30px;
            text-align: center;
        }
        .phone-btn {
            background: var(--gold);
            color: var(--primary-dark);
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .phone-btn:hover { background: var(--gold-dark); }

        /* ===== العقارات ===== */
        .section-title {
            font-size: 28px;
            margin: 50px 0 25px;
            color: var(--text-dark);
            border-right: 4px solid var(--gold);
            padding-right: 15px;
        }
        .section-title i { color: var(--gold); margin-left: 8px; }

        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        .property-card {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid #eee;
            transition: 0.3s;
        }
        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        .property-image {
            height: 180px;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #aaa;
            overflow: hidden;
        }
        .property-image img { width: 100%; height: 100%; object-fit: cover; }
        .property-body { padding: 18px; }
        .property-title { font-size: 18px; font-weight: bold; }
        .property-price {
            font-size: 20px;
            color: var(--gold);
            font-weight: bold;
        }
        .property-detail {
            font-size: 14px;
            color: var(--text-gray);
            margin: 3px 0;
        }
        .property-detail i { width: 20px; color: var(--primary-dark); }
        .badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 13px;
            color: white;
            margin-top: 5px;
        }
        .badge-available { background: #2ecc71; }
        .badge-reserved { background: #f39c12; }
        .badge-sold { background: #e74c3c; }

        .property-footer {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .view-btn {
            background: var(--primary-dark);
            color: white;
            padding: 6px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }
        .view-btn:hover {
            background: var(--gold);
            color: var(--primary-dark);
        }

        /* ===== الفوتر ===== */
        .footer {
            background: var(--primary-dark);
            color: #ccc;
            padding: 30px 0;
            margin-top: 50px;
            text-align: center;
        }
        .footer strong { color: var(--gold); }

        /* ===== التجاوب ===== */
        @media (max-width: 768px) {
            .hero h1 { font-size: 28px; }
            .office-info { flex-direction: column; align-items: center; gap: 15px; }
            .header-content { flex-direction: column; gap: 10px; text-align: center; }
            .properties-grid { grid-template-columns: 1fr; }
            .section-title { font-size: 22px; }
        }
    </style>
</head>
<body>

    <!-- ===== الهيدر ===== -->
    <header class="header">
        <div class="container header-content">
            <div class="logo"><i class="fas fa-building"></i> <span>مكتب</span> الأمين</div>
            <nav class="nav">
                <a href="/"><i class="fas fa-home"></i> الرئيسية</a>
                <a href="/properties"><i class="fas fa-list"></i> العقارات</a>
                @if(Auth::check())
                    <a href="/admin"><i class="fas fa-user-cog"></i> لوحة التحكم</a>
                @endif
            </nav>
        </div>
    </header>

    <!-- ===== الهيرو ===== -->
    <section class="hero">
        <div class="container">
            <h1><i class="fas fa-gem"></i> مكتب <span class="highlight">الأمين</span> للعقارات</h1>
            <p>شريكك الموثوق في بيع وشراء العقارات في بغداد</p>
            <a href="/properties" class="btn"><i class="fas fa-search"></i> استعرض العقارات</a>
        </div>
    </section>

    <!-- ===== معلومات المكتب ===== -->
    <div class="container">
        <div class="office-info">
            <div class="item"><i class="fas fa-map-marker-alt"></i> بغداد - الكاظمية - شاطئ التاجي</div>
            <div class="item">
                <i class="fas fa-phone"></i>
                <button class="phone-btn" onclick="copyPhone()"><i class="fas fa-copy"></i> 07722505080</button>
            </div>
            <div class="item"><i class="fas fa-handshake"></i> خدمات عقارية متكاملة</div>
        </div>
    </div>

    <!-- ===== العقارات ===== -->
    <div class="container">
        <h2 class="section-title"><i class="fas fa-home"></i> أحدث العقارات</h2>
        <div class="properties-grid">
            @forelse($properties as $property)
            <div class="property-card">
                <div class="property-image">
                    @php $photo = $property->photos()->where('is_primary', true)->first(); @endphp
                    @if($photo) <img src="{{ $photo->path }}" alt="{{ $property->title }}"> @else <i class="fas fa-home"></i> @endif
                </div>
                <div class="property-body">
                    <div class="property-title">{{ $property->title }}</div>
                    <div class="property-price">{{ number_format($property->price) }} د.ع</div>
                    <div class="property-detail"><i class="fas fa-map-marker-alt"></i> {{ $property->city }}</div>
                    <div class="property-detail"><i class="fas fa-vector-square"></i> {{ $property->area }} م²</div>
                    <span class="badge badge-{{ $property->status }}">
                        @if($property->status == 'available') متاحة
                        @elseif($property->status == 'reserved') محجوزة
                        @else مباعة
                        @endif
                    </span>
                    <div class="property-footer">
                        <a href="/property/{{ $property->id }}" class="view-btn"><i class="fas fa-eye"></i> تفاصيل</a>
                    </div>
                </div>
            </div>
            @empty
            <div style="text-align:center; padding:50px; color:#999; grid-column: span 3;">
                <i class="fas fa-home" style="font-size:50px;"></i>
                <p style="margin-top:15px;">لا توجد عقارات حالياً</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- ===== الفوتر ===== -->
    <footer class="footer">
        <div class="container">
            <p>© 2026 <strong>مكتب الأمين للعقارات</strong> - جميع الحقوق محفوظة</p>
            <p style="font-size:14px; opacity:0.7; margin-top:5px;">📍 بغداد - الكاظمية - شاطئ التاجي | 📞 07722505080</p>
        </div>
    </footer>

    <script>
        function copyPhone() {
            const phone = '07722505080';
            navigator.clipboard.writeText(phone).then(() => {
                alert('✅ تم نسخ الرقم: ' + phone);
            }).catch(() => {
                const input = document.createElement('input');
                input.value = phone;
                document.body.appendChild(input);
                input.select();
                document.execCommand('copy');
                document.body.removeChild(input);
                alert('✅ تم نسخ الرقم: ' + phone);
            });
        }
    </script>

</body>
</html>
