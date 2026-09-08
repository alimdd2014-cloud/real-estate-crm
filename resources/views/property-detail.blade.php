<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - مكتب الأمين</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Tajawal', sans-serif; background: #f0f2f5; color: #1a1a2e; }

        .container { max-width: 1200px; margin: auto; padding: 0 20px; }

        .header {
            background: #0a1628;
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
            color: #c9a84c;
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
        .nav a:hover { color: #c9a84c; }

        /* ===== معرض الصور ===== */
        .main-image {
            width: 100%;
            height: 400px;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            color: #aaa;
            overflow: hidden;
            border-radius: 12px;
            margin: 20px 0;
            cursor: pointer;
        }
        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnails {
            display: flex;
            gap: 10px;
            margin: 10px 0;
            overflow-x: auto;
            padding: 5px 0;
            justify-content: center;
            flex-wrap: wrap;
        }
        .thumbnails img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: 0.3s;
        }
        .thumbnails img:hover {
            border-color: #c9a84c;
        }
        .thumbnails img.active {
            border-color: #c9a84c;
        }

        /* ===== Lightbox ===== */
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .lightbox.active {
            display: flex;
        }
        .lightbox img {
            max-width: 90%;
            max-height: 80%;
            border-radius: 10px;
            box-shadow: 0 0 50px rgba(0,0,0,0.5);
        }
        .lightbox .close {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 40px;
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }
        .lightbox .close:hover { color: #e74c3c; }
        .lightbox .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 40px;
            color: white;
            cursor: pointer;
            padding: 20px;
            transition: 0.3s;
            background: rgba(0,0,0,0.3);
            border-radius: 50%;
        }
        .lightbox .nav-btn:hover { background: rgba(0,0,0,0.7); }
        .lightbox .prev { left: 20px; }
        .lightbox .next { right: 20px; }
        .lightbox .counter {
            color: white;
            margin-top: 15px;
            font-size: 16px;
            background: rgba(0,0,0,0.5);
            padding: 8px 20px;
            border-radius: 20px;
        }

        .purpose-banner {
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin: 15px 0;
        }
        .purpose-sale { background: #c9a84c; color: #0a1628; }
        .purpose-rent { background: #2ecc71; color: white; }

        .detail-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.06);
            border: 1px solid #eee;
        }
        .detail-title {
            font-size: 32px;
            color: #0a1628;
            margin-bottom: 10px;
        }
        .detail-price {
            font-size: 28px;
            color: #c9a84c;
            font-weight: bold;
        }
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 15px;
            margin: 20px 0;
            padding: 20px 0;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }
        .detail-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #555;
            font-size: 16px;
        }
        .detail-item i {
            width: 28px;
            color: #0a1628;
            font-size: 18px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 18px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 16px;
            color: white;
            margin: 5px 0;
        }
        .status-available { background: #2ecc71; }
        .status-reserved { background: #f39c12; }
        .status-sold { background: #e74c3c; }

        .detail-description {
            font-size: 18px;
            color: #555;
            line-height: 2;
            margin: 20px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            border-right: 4px solid #c9a84c;
        }

        #map {
            height: 350px;
            border-radius: 12px;
            margin: 20px 0;
            border: 2px solid #c9a84c;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 20px 0;
        }
        .action-buttons .btn {
            flex: 1;
            min-width: 150px;
            padding: 14px 20px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            color: white;
            transition: 0.3s;
        }
        .action-buttons .btn:hover { transform: scale(1.02); }
        .btn-whatsapp { background: #25D366; }
        .btn-google-maps { background: #4285F4; }
        .btn-back { background: #0a1628; color: white; }

        .social-icons {
            text-align: center;
            margin: 40px 0 20px;
        }
        .social-icons h4 {
            color: #c9a84c;
            margin-bottom: 15px;
        }
        .social-icons .social-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 50px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin: 5px;
            transition: 0.3s;
        }
        .social-icons .social-link:hover { transform: scale(1.05); }
        .social-icons .whatsapp { background: #25D366; }
        .social-icons .facebook { background: #1877F2; }
        .social-icons .instagram { background: #E4405F; }
        .social-icons .youtube { background: #FF0000; }

        .footer {
            background: #0a1628;
            color: #ccc;
            padding: 30px 0;
            margin-top: 50px;
            text-align: center;
        }
        .footer strong { color: #c9a84c; }

        @media (max-width: 768px) {
            .header-content { flex-direction: column; gap: 10px; text-align: center; }
            .main-image { height: 200px; }
            .detail-title { font-size: 24px; }
            .detail-price { font-size: 22px; }
            .detail-grid { grid-template-columns: 1fr; }
            .detail-item { font-size: 16px; }
            .detail-description { font-size: 16px; padding: 15px; }
            .action-buttons .btn {
                font-size: 16px;
                padding: 12px 16px;
                min-width: 120px;
            }
            .purpose-banner { font-size: 18px; padding: 10px; }
            .social-icons .social-link { padding: 8px 14px; font-size: 14px; }
            .thumbnails img { width: 60px; height: 45px; }
            .lightbox .nav-btn { font-size: 25px; padding: 10px; }
        }
    </style>
</head>
<body>

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

    <div class="container">

        <!-- ===== معرض الصور ===== -->
        @php
            $photos = \App\Models\Photo::where('property_id', $property->id)->get();
            $allPhotos = $photos->pluck('path')->toArray();
        @endphp

        @if(count($allPhotos) > 0)
            <div class="main-image" onclick="openLightbox(0)">
                <img id="mainImage" src="/{{ $allPhotos[0] }}" alt="{{ $property->title }}">
            </div>

            <div class="thumbnails">
                @foreach($photos as $index => $photo)
                    <img src="{{ $photo->path }}" 
                         alt="{{ $property->title }}" 
                         onclick="openLightbox({{ $index }})"
                         class="{{ $index == 0 ? 'active' : '' }}">
                @endforeach
            </div>
        @else
            <div class="main-image" style="display:flex; align-items:center; justify-content:center; font-size:60px; color:#aaa;">
                <i class="fas fa-home"></i>
            </div>
        @endif

        <!-- ===== نافذة Lightbox ===== -->
        <div class="lightbox" id="lightbox">
            <span class="close" onclick="closeLightbox()">&times;</span>
            <span class="nav-btn prev" onclick="changeLightboxImage(-1)">&#10094;</span>
            <span class="nav-btn next" onclick="changeLightboxImage(1)">&#10095;</span>
            <img id="lightbox-img" src="" alt="صورة العقار">
            <div class="counter" id="lightbox-counter">1 / 1</div>
        </div>

        <!-- ===== شريط الغرض ===== -->
        <div class="purpose-banner {{ $property->purpose == 'sale' ? 'purpose-sale' : 'purpose-rent' }}">
            <i class="fas fa-tag"></i>
            {{ $property->purpose == 'sale' ? '🏷️ للبيع' : '🔑 للإيجار' }}
        </div>

        <!-- ===== تفاصيل العقار ===== -->
        <div class="detail-card">
            <h1 class="detail-title">{{ $property->title }}</h1>
            <p class="detail-price">{{ number_format($property->price) }} دينار عراقي</p>

            <div class="detail-grid">
                <div class="detail-item"><i class="fas fa-map-marker-alt"></i> {{ $property->city }} - {{ $property->neighborhood }}</div>
                <div class="detail-item"><i class="fas fa-vector-square"></i> {{ $property->area }} م²</div>

                @if($property->type == 'land' && $property->length && $property->width)
                    <div class="detail-item"><i class="fas fa-ruler-combined"></i> {{ $property->length }} × {{ $property->width }} م</div>
                @endif

                <div class="detail-item">
                    <i class="fas fa-building"></i>
                    النوع:
                    @if($property->type == 'house') دار
                    @elseif($property->type == 'land') قطعة أرض
                    @elseif($property->type == 'farm') مزرعة
                    @elseif($property->type == 'villa') فيلا
                    @else {{ $property->type }}
                    @endif
                </div>

                <div class="detail-item">
                    <i class="fas fa-circle" style="color: #2ecc71;"></i>
                    الحالة:
                    <span class="status-badge status-{{ $property->status }}">
                        @if($property->status == 'available') متاحة
                        @elseif($property->status == 'reserved') محجوزة
                        @else مباعة
                        @endif
                    </span>
                </div>

                <div class="detail-item">
                    <i class="fas fa-calendar-alt"></i>
                    تاريخ الإضافة: {{ \Carbon\Carbon::parse($property->created_at)->format('Y-m-d') }}
                </div>
            </div>

            <!-- ===== الوصف ===== -->
            <div class="detail-description">
                {{ $property->description ?? 'لا يوجد وصف لهذا العقار' }}
            </div>

            <!-- ===== الخريطة ===== -->
            @if($property->latitude && $property->longitude)
                <div id="map"></div>
            @else
                <div style="text-align:center; padding:20px; background:#f8f9fa; border-radius:8px; color:#999; margin:20px 0;">
                    <i class="fas fa-map-marker-alt" style="font-size:40px;"></i>
                    <p style="margin-top:10px;">لا يوجد موقع محدد لهذا العقار</p>
                </div>
            @endif

            <!-- ===== أزرار التواصل ===== -->
            <div class="action-buttons">
                <a href="https://wa.me/{{ $property->owner_phone }}" target="_blank" class="btn btn-whatsapp">
                    <i class="fab fa-whatsapp"></i> راسلنا على واتساب
                </a>
                @if($property->latitude && $property->longitude)
                    <a href="https://www.google.com/maps?q={{ $property->latitude }},{{ $property->longitude }}" target="_blank" class="btn btn-google-maps">
                        <i class="fas fa-map-marked-alt"></i> افتح في خرائط Google
                    </a>
                @endif
                <a href="/properties" class="btn btn-back">
                    <i class="fas fa-arrow-right"></i> العودة للقائمة
                </a>
            </div>
        </div>

        <!-- ===== أيقونات التواصل الاجتماعي ===== -->
        <div class="social-icons">
            <h4><i class="fas fa-share-alt"></i> تواصل معنا</h4>
            <div>
                <a href="https://wa.me/07722505080" target="_blank" class="social-link whatsapp">
                    <i class="fab fa-whatsapp"></i> واتساب
                </a>
                <a href="https://facebook.com" target="_blank" class="social-link facebook">
                    <i class="fab fa-facebook"></i> فيسبوك
                </a>
                <a href="https://instagram.com" target="_blank" class="social-link instagram">
                    <i class="fab fa-instagram"></i> إنستغرام
                </a>
                <a href="https://youtube.com" target="_blank" class="social-link youtube">
                    <i class="fab fa-youtube"></i> يوتيوب
                </a>
            </div>
        </div>

    </div>

    <footer class="footer">
        <div class="container">
            <p>© 2026 <strong>مكتب الأمين للعقارات</strong> - جميع الحقوق محفوظة</p>
            <p style="font-size:14px; opacity:0.7; margin-top:5px;">📍 بغداد - الكاظمية - شاطئ التاجي | 📞 07722505080</p>
        </div>
    </footer>

    <script>
        // ===== Lightbox =====
        const lightboxImages = @json($allPhotos);
        let lightboxIndex = 0;

        function openLightbox(index) {
            if (lightboxImages.length === 0) return;
            lightboxIndex = index;
            const img = document.getElementById('lightbox-img');
            img.src = lightboxImages[lightboxIndex];
            document.getElementById('lightbox').classList.add('active');
            document.getElementById('lightbox-counter').textContent = (lightboxIndex + 1) + ' / ' + lightboxImages.length;
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function changeLightboxImage(direction) {
            if (lightboxImages.length === 0) return;
            lightboxIndex += direction;
            if (lightboxIndex < 0) lightboxIndex = lightboxImages.length - 1;
            if (lightboxIndex >= lightboxImages.length) lightboxIndex = 0;
            const img = document.getElementById('lightbox-img');
            img.src = lightboxImages[lightboxIndex];
            document.getElementById('lightbox-counter').textContent = (lightboxIndex + 1) + ' / ' + lightboxImages.length;
        }

        // إغلاق Lightbox بالضغط على ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') changeLightboxImage(-1);
            if (e.key === 'ArrowRight') changeLightboxImage(1);
        });

        // إغلاق بالضغط على الخلفية
        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this) closeLightbox();
        });

        // ===== الخريطة =====
        @if($property->latitude && $property->longitude)
            var map = L.map('map').setView([{{ $property->latitude }}, {{ $property->longitude }}], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);
            L.marker([{{ $property->latitude }}, {{ $property->longitude }}])
                .addTo(map)
                .bindPopup('<b>{{ $property->title }}</b><br>{{ $property->city }} - {{ $property->neighborhood }}')
                .openPopup();
        @endif
    </script>

</body>
</html>
