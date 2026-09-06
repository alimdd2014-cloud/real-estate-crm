<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - مكتب الأمين</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Tajawal', sans-serif; background: #f0f2f5; }

        .header {
            background: #0a1628;
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .container { max-width: 1200px; margin: auto; padding: 0 20px; }
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

        .admin-title {
            font-size: 28px;
            margin: 30px 0 20px;
            border-right: 4px solid #c9a84c;
            padding-right: 15px;
        }
        .admin-title i { color: #c9a84c; margin-left: 8px; }

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
            text-decoration: none;
            display: inline-block;
        }
        .add-btn:hover { background: #b8973a; }

        .table-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        thead {
            background: #0a1628;
            color: white;
        }
        thead th {
            padding: 12px 10px;
            font-size: 15px;
        }
        tbody td {
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }
        tbody tr:hover { background: #f8f9fa; }

        .badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 13px;
            color: white;
        }
        .badge-available { background: #2ecc71; }
        .badge-reserved { background: #f39c12; }
        .badge-sold { background: #e74c3c; }

        .status-select {
            padding: 5px 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 14px;
            cursor: pointer;
            background: white;
        }
        .status-select:focus { outline: none; border-color: #c9a84c; }

        .btn-action {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
            margin: 0 3px;
        }
        .btn-edit {
            background: #3498db;
            color: white;
        }
        .btn-edit:hover { background: #2980b9; }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }
        .btn-delete:hover { background: #c0392b; }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        .footer {
            background: #0a1628;
            color: #ccc;
            padding: 30px 0;
            margin-top: 50px;
            text-align: center;
        }
        .footer strong { color: #c9a84c; }

        /* ===== إحصائيات الزوار ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            text-align: center;
        }
        .stat-number {
            font-size: 32px;
            font-weight: bold;
        }
        .stat-number.online { color: #2ecc71; }
        .stat-number.today { color: #3498db; }
        .stat-number.month { color: #c9a84c; }
        .stat-number.total { color: #e74c3c; }
        .stat-label {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .header-content { flex-direction: column; gap: 10px; text-align: center; }
            .admin-title { font-size: 22px; }
            table { font-size: 12px; }
            thead th, tbody td { padding: 8px 5px; }
            .btn-action { padding: 4px 8px; font-size: 11px; }
            .status-select { font-size: 12px; padding: 3px 6px; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
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
                <a href="/admin"><i class="fas fa-user-cog"></i> لوحة التحكم</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2 class="admin-title"><i class="fas fa-cogs"></i> لوحة التحكم</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- ===== إعدادات الموقع ===== -->
        <div style="background: white; padding: 20px; border-radius: 12px; margin-bottom: 30px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
            <h3 style="color: #c9a84c; margin-bottom: 15px;"><i class="fas fa-cog"></i> إعدادات الموقع</h3>
            <form action="/admin/settings" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                    <div>
                        <label style="font-weight: bold; display: block; margin-bottom: 5px;">رقم الهاتف</label>
                        <input type="text" name="phone" value="{{ \App\Models\Setting::get('phone') }}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
                    </div>
                    <div>
                        <label style="font-weight: bold; display: block; margin-bottom: 5px;">اسم المكتب</label>
                        <input type="text" name="owner_name" value="{{ \App\Models\Setting::get('owner_name') }}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
                    </div>
                    <div>
                        <label style="font-weight: bold; display: block; margin-bottom: 5px;">البريد الإلكتروني</label>
                        <input type="email" name="owner_email" value="{{ \App\Models\Setting::get('owner_email') }}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
                    </div>
                    <div>
                        <label style="font-weight: bold; display: block; margin-bottom: 5px;">العنوان</label>
                        <input type="text" name="owner_address" value="{{ \App\Models\Setting::get('owner_address') }}" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="font-weight: bold; display: block; margin-bottom: 5px;">وصف المكتب</label>
                        <textarea name="owner_description" rows="2" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">{{ \App\Models\Setting::get('owner_description') }}</textarea>
                    </div>
                </div>
                <button type="submit" style="background: #c9a84c; color: #0a1628; border: none; padding: 10px 24px; border-radius: 8px; font-weight: bold; cursor: pointer; margin-top: 15px;">
                    <i class="fas fa-save"></i> حفظ الإعدادات
                </button>
            </form>
        </div>

        <!-- ===== إحصائيات الزوار ===== -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number online">{{ \App\Models\Visitor::getOnlineCount() }}</div>
                <div class="stat-label"><i class="fas fa-circle" style="color: #2ecc71;"></i> متصلون الآن</div>
            </div>
            <div class="stat-card">
                <div class="stat-number today">{{ \App\Models\Visitor::getTodayCount() }}</div>
                <div class="stat-label"><i class="fas fa-calendar-day"></i> زوار اليوم</div>
            </div>
            <div class="stat-card">
                <div class="stat-number month">{{ \App\Models\Visitor::getMonthCount() }}</div>
                <div class="stat-label"><i class="fas fa-calendar-alt"></i> زوار هذا الشهر</div>
            </div>
            <div class="stat-card">
                <div class="stat-number total">{{ \App\Models\Visitor::getTotalCount() }}</div>
                <div class="stat-label"><i class="fas fa-users"></i> إجمالي الزوار</div>
            </div>
        </div>

        <!-- ===== زر إضافة عقار ===== -->
        <a href="/properties" class="add-btn"><i class="fas fa-plus"></i> إضافة عقار جديد</a>

        <!-- ===== جدول العقارات ===== -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>السعر (د.ع)</th>
                        <th>الغرض</th>
                        <th>الحالة</th>
                        <th>تاريخ الإضافة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($properties as $property)
                    <tr>
                        <td>{{ $property->id }}</td>
                        <td>{{ $property->title }}</td>
                        <td>{{ number_format($property->price) }}</td>
                        <td>{{ $property->purpose == 'sale' ? 'بيع' : 'إيجار' }}</td>
                        <!-- ===== تغيير الحالة ===== -->
                        <td>
                            <form action="/admin/update-status/{{ $property->id }}" method="POST" style="display:inline;">
                                @csrf
                                <select name="status" class="status-select" onchange="this.form.submit()" style="padding:5px 10px; border-radius:6px; border:1px solid #ddd; font-size:14px; cursor:pointer;">
                                    <option value="available" {{ $property->status == 'available' ? 'selected' : '' }}>✅ متاح</option>
                                    <option value="reserved" {{ $property->status == 'reserved' ? 'selected' : '' }}>⏳ محجوز</option>
                                    <option value="sold" {{ $property->status == 'sold' ? 'selected' : '' }}>❌ مباع</option>
                                </select>
                            </form>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($property->created_at)->format('Y-m-d') }}</td>
                        <td>
                            <a href="/property/{{ $property->id }}" class="btn-action btn-edit"><i class="fas fa-eye"></i> عرض</a>
                            <form action="/properties/{{ $property->id }}" method="POST" style="display:inline;" onsubmit="return confirm('هل أنت متأكد من حذف هذا العقار؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i> حذف</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if(count($properties) == 0)
                <div style="text-align:center; padding:50px; color:#999;">
                    <i class="fas fa-home" style="font-size:50px;"></i>
                    <p style="margin-top:15px;">لا توجد عقارات حالياً</p>
                </div>
            @endif
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>© 2026 <strong>مكتب الأمين للعقارات</strong> - جميع الحقوق محفوظة</p>
        </div>
    </footer>

</body>
</html>
