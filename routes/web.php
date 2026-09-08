<?php

use Illuminate\Support\Facades\Route;
use App\Models\Property;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Services\ImageKitService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// ========== الصفحة الرئيسية ==========
Route::get('/', function () {
    $properties = Property::all();
    return view('index', ['properties' => $properties]);
});

// ========== صفحة تسجيل الدخول ==========
Route::get('/login', function () {
    return view('login');
});

// ========== معالجة تسجيل الدخول ==========
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        return redirect('/admin');
    }
    
    return back()->with('error', 'البريد الإلكتروني أو كلمة المرور غير صحيحة');
});

// ========== تسجيل الخروج ==========
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
});

// ========== لوحة التحكم (محمية) ==========
Route::get('/admin', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    $properties = Property::all();
    return view('admin', ['properties' => $properties]);
});

// ========== عرض كل العقارات ==========
Route::get('/properties', function () {
    $properties = Property::all();
    return view('properties', ['properties' => $properties]);
});

// ========== عرض عقار معين ==========
Route::get('/property/{id}', function ($id) {
    $property = Property::find($id);
    if (!$property) {
        return redirect('/properties')->with('error', 'العقار غير موجود');
    }
    return view('property-detail', ['property' => $property]);
});

// ========== إضافة عقار جديد (للمدير فقط) ==========
Route::post('/properties', function (Request $request, ImageKitService $imageKit) {
    if (!Auth::check()) {
        return redirect('/login');
    }
    
    $property = new Property();
    $property->title = $request->title;
    $property->description = $request->description;
    $property->type = $request->type;
    $property->purpose = $request->purpose;
    $property->price = $request->price;
    $property->area = $request->area;
    $property->length = $request->length;
    $property->width = $request->width;
    $property->city = $request->city;
    $property->neighborhood = $request->neighborhood;
    $property->status = $request->status ?? 'available';
    $property->owner_name = $request->owner_name;
    $property->owner_phone = $request->owner_phone;
    $property->latitude = $request->latitude;
    $property->longitude = $request->longitude;
    $property->save();

    // رفع الصور
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $filename = time() . '_' . $image->getClientOriginalName();
            
            $result = $imageKit->upload($image, $filename);

            if ($result->error) {
                return redirect('/properties')->with('error', 'فشل رفع الصورة إلى ImageKit');
            }

            if ($result->result && isset($result->result->url)) {
                $property->photos()->create([
                    'path' => $result->result->url,
                    'is_primary' => false
                ]);
            }
        }
        // جعل أول صورة رئيسية
        if ($property->photos()->count() > 0) {
            $firstPhoto = $property->photos()->first();
            $firstPhoto->is_primary = true;
            $firstPhoto->save();
        }
    }

    return redirect('/properties')->with('success', '✅ تم إضافة العقار بنجاح!');
});

// ========== حذف عقار (للمدير فقط) ==========
Route::delete('/properties/{id}', function ($id) {
    if (!Auth::check()) {
        return redirect('/login');
    }
    
    $property = Property::find($id);
    if ($property) {
        $property->delete();
    }
    return redirect('/admin')->with('success', '🗑️ تم حذف العقار بنجاح!');
});

// ========== تحديث حالة العقار (للمدير فقط) ==========
Route::post('/admin/update-status/{id}', function ($id, Request $request) {
    if (!Auth::check()) {
        return redirect('/login');
    }
    
    $property = Property::find($id);
    if ($property) {
        $property->status = $request->status;
        $property->save();
    }
    return redirect('/admin')->with('success', '✅ تم تحديث حالة العقار بنجاح!');
});

// ========== حفظ إعدادات الموقع ==========
Route::post('/admin/settings', function (Request $request) {
    if (!Auth::check()) {
        return redirect('/login');
    }

    \App\Models\Setting::set('phone', $request->phone);
    \App\Models\Setting::set('owner_name', $request->owner_name);
    \App\Models\Setting::set('owner_email', $request->owner_email);
    \App\Models\Setting::set('owner_address', $request->owner_address);
    \App\Models\Setting::set('owner_description', $request->owner_description);

    return redirect('/admin')->with('success', '✅ تم تحديث إعدادات الموقع بنجاح!');
});

// ========== البحث ==========
Route::get('/search', function (Request $request) {
    $query = Property::query();

    if ($request->city) {
        $query->where('city', 'like', '%' . $request->city . '%');
    }

    if ($request->min_price) {
        $query->where('price', '>=', $request->min_price);
    }

    if ($request->max_price) {
        $query->where('price', '<=', $request->max_price);
    }

    if ($request->type) {
        $query->where('type', $request->type);
    }

    $properties = $query->get();
    return view('properties', ['properties' => $properties]);
});

// ========== إضافة عقار تجريبي ==========
Route::get('/add-test', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    
    $property = new Property();
    $property->title = 'فيلا فاخرة للبيع في بغداد';
    $property->description = 'فيلا حديثة مكونة من 5 غرف وصالة كبيرة';
    $property->type = 'villa';
    $property->purpose = 'sale';
    $property->price = 250000000;
    $property->area = 600;
    $property->length = null;
    $property->width = null;
    $property->city = 'بغداد';
    $property->neighborhood = 'المنصور';
    $property->status = 'available';
    $property->owner_name = 'أحمد محمد';
    $property->owner_phone = '07701234567';
    $property->latitude = '33.3152';
    $property->longitude = '44.3661';
    $property->save();

    return redirect('/properties')->with('success', '✅ تم إضافة عقار تجريبي!');
});

// ========== عرض البيانات (API) ==========
Route::get('/api/properties', function () {
    return Property::all();
});
