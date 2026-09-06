<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return Property::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:land,house,apartment',
            'price' => 'required|numeric',
            'area' => 'required|numeric',
            'city' => 'required|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'status' => 'in:available,reserved,sold',
            'owner_name' => 'required|string|max:255',
            'owner_phone' => 'required|string|max:20',
            'images' => 'nullable|array',
        ]);

        return Property::create($validated);
    }

    public function show(Property $property)
    {
        return $property;
    }

    public function update(Request $request, Property $property)
    {
        $property->update($request->all());
        return $property;
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json(['message' => 'تم حذف العقار بنجاح']);
    }
}
