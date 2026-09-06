<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>العقارات - مكتب الأمين</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

        .page-title {
            font-size: 28px;
            margin: 30px 0 20px;
            border-right: 4px solid #c9a84c;
            padding-right: 15px;
        }
        .page-title i { color: #c9a84c; margin-left: 8px; }

        .add-btn {
            background: #c9a84c;
            color: #0a1628;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            margin-bottom: 20px;
        }
        .add-btn:hover { background: #b8973a; }

        .form-container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            margin-bottom: 30px;
            display: none;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 15px;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 4px;
            color: #333;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }
        .submit-btn {
            background: #0a1628;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
        }
        .submit-btn:hover { background: #c9a84c; color: #0a1628; }

        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        .property-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
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
        .property-price { font-size: 20px; color: #c9a84c; font-weight: bold; }

        /* ===== الغرض + الحالة ===== */
        .property-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin: 6px 0 10px;
        }
        .badge-purpose {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: bold;
        }
        .badge-purpose.sale { background: #c9a84c; color: #0a1628; }
        .badge-purpose.rent { background: #2ecc71; color: white; }

        .badge-status {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: bold;
            color: white;
        }
        .badge-status.available { background: #2ecc71; }
        .badge-status.reserved { background: #f39c12; }
        .badge-status.sold { background: #e74c3c; }

        .property-detail {
            font-size: 14px;
            color: #6c757d;
            margin: 3px 0;
        }
        .property-detail i { width: 20px; color: #0a1628; }

        .property-footer {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .view-btn {
            background: #0a1628;
            color: white;
            padding: 6px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }
        .view-btn:hover { background: #c9a84c; color: #0a1628; }
        .delete-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
        }
        .delete-btn:hover { background: #c0392b; }

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
            .form-grid { grid-template-columns: 1fr !important; }
            .form-group { grid-column: span 1 !important; }
            .properties-grid { grid-template-columns: 1fr; }
            .container { padding: 0 10px; }
            .page-title { font-size: 22px; }
            .add-btn { width: 100%; text-align: center; }
            .submit-btn { font-size: 14px; padding: 10px; }
            .property-image { height: 150px; }
            .property-title { font-size: 16px; }
            .property-price { font-size: 18px; }
            .form-group input, .form-group select, .form-group textarea {
                font-size: 16px;
                padding: 12px;
            }
            .form-container { padding: 15px; }
            .social-icons .social-link {
                padding: 8px 14px;
                font-size: 14px;
            }
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
        <h2 class="page-title"><i class="fas fa-list"></i> قائمة العقارات</h2>

        @if(session('success'))
            <div style="background:#d4edda; color:#155724; padding:12px; border-radius:8px; margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        @if(Auth::check())
            <button class="add-btn" onclick="toggleForm()"><i class="fas fa-plus"></i> إضافة عقار</button>

            <div class="form-container" id="addForm">
                <h3 style="margin-bottom:15px;"><i class="fas fa-edit"></i> إضافة عقار جديد</h3>
                <form action="/properties" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group" style="grid-column: span 2;">
                            <label>العنوان</label>
                            <input type="text" name="title" required>
                        </div>

                        <div class="form-group">
                            <label>السعر (د.ع)</label>
                            <input type="number" name="price">
                        </div>

                        <div class="form-group">
                            <label>الغرض</label>
                            <select name="purpose" required>
                                <option value="sale">بيع</option>
                                <option value="rent">إيجار</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>النوع</label>
                            <select name="type" id="propertyType" required>
                                <option value="house">دار</option>
                                <option value="land">قطعة أرض</option>
                                <option value="farm">مزرعة</option>
                                <option value="villa">فيلا</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>المساحة (م²)</label>
                            <input type="number" name="area" id="area" required>
                        </div>

                        <div class="form-group" id="lengthGroup" style="display: none;">
                            <label>الطول (م)</label>
                            <input type="number" name="length" id="length" step="0.01" placeholder="مثال: 30">
                        </div>
                        <div class="form-group" id="widthGroup" style="display: none;">
                            <label>العرض (م)</label>
                            <input type="number" name="width" id="width" step="0.01" placeholder="مثال: 20">
                        </div>

                        <div class="form-group">
                            <label>المدينة</label>
                            <input type="text" name="city" required>
                        </div>
                        <div class="form-group">
                            <label>الحي</label>
                            <input type="text" name="neighborhood">
                        </div>

                        <div class="form-group">
                            <label>اسم المالك</label>
                            <input type="text" name="owner_name" required>
                        </div>
                        <div class="form-group">
                            <label>جوال المالك</label>
                            <input type="tel" name="owner_phone" required>
                        </div>

                        <div class="form-group">
                            <label>خط العرض (Latitude)</label>
                            <input type="text" name="latitude" placeholder="مثال: 33.3152">
                        </div>
                        <div class="form-group">
                            <label>خط الطول (Longitude)</label>
                            <input type="text" name="longitude" placeholder="مثال: 44.3661">
                        </div>

                        <div class="form-group" style="grid-column: span 2;">
                            <label>صور العقار</label>
                            <input type="file" name="images[]" multiple accept="image/*">
                        </div>

                        <div class="form-group" style="grid-column: span 2;">
                            <label>الوصف</label>
                            <textarea name="description" rows="2"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn"><i class="fas fa-save"></i> حفظ العقار</button>
                </form>
            </div>
        @endif

        <div class="properties-grid">
            @forelse($properties as $property)
            <div class="property-card">
                <div class="property-image">
                    @php $photo = $property->photos()->where('is_primary', true)->first(); @endphp
                    @if($photo) <img src="/{{ $photo->path }}" alt="{{ $property->title }}"> @else <i class="fas fa-home"></i> @endif
                </div>
                <div class="property-body">
                    <div class="property-title">{{ $property->title }}</div>
                    <div class="property-price">{{ number_format($property->price) }} د.ع</div>

                    <!-- ===== الغرض + الحالة ===== -->
                    <div class="property-badges">
                        <span class="badge-purpose {{ $property->purpose == 'sale' ? 'sale' : 'rent' }}">
                            {{ $property->purpose == 'sale' ? '🏷️ للبيع' : '🔑 للإيجار' }}
                        </span>
                        <span class="badge-status {{ $property->status }}">
                            @if($property->status == 'available') ✅ متاح
                            @elseif($property->status == 'reserved') ⏳ محجوز
                            @else ❌ مباع
                            @endif
                        </span>
                    </div>

                    <div class="property-detail">
                        <i class="fas fa-building"></i>
                        النوع:
                        @if($property->type == 'house') دار
                        @elseif($property->type == 'land') قطعة أرض
                        @elseif($property->type == 'farm') مزرعة
                        @elseif($property->type == 'villa') فيلا
                        @else {{ $property->type }}
                        @endif
                    </div>

                    <div class="property-detail"><i class="fas fa-map-marker-alt"></i> {{ $property->city }}</div>
                    <div class="property-detail"><i class="fas fa-vector-square"></i> {{ $property->area }} م²</div>

                    @if($property->type == 'land' && $property->length && $property->width)
                        <div class="property-detail"><i class="fas fa-ruler-combined"></i> {{ $property->length }} × {{ $property->width }} م</div>
                    @endif

                    <div class="property-footer">
                        <a href="/property/{{ $property->id }}" class="view-btn"><i class="fas fa-eye"></i> تفاصيل</a>
                        @if(Auth::check())
                        <form action="/properties/{{ $property->id }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="delete-btn"><i class="fas fa-trash"></i></button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div style="text-align:center; padding:50px; color:#999; grid-column: span 3;">
                <i class="fas fa-home" style="font-size:50px;"></i>
                <p style="margin-top:15px;">لا توجد عقارات</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="container">
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
        function toggleForm() {
            const f = document.getElementById('addForm');
            f.style.display = f.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('propertyType');
            const lengthGroup = document.getElementById('lengthGroup');
            const widthGroup = document.getElementById('widthGroup');

            function toggleLengthWidth() {
                if (typeSelect.value === 'land') {
                    lengthGroup.style.display = 'block';
                    widthGroup.style.display = 'block';
                } else {
                    lengthGroup.style.display = 'none';
                    widthGroup.style.display = 'none';
                    document.getElementById('length').value = '';
                    document.getElementById('width').value = '';
                }
            }

            typeSelect.addEventListener('change', toggleLengthWidth);
            toggleLengthWidth();
        });
    </script>

</body>
</html>
