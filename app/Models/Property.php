<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'purpose',
        'price',
        'price_optional',
        'area',
        'length',
        'width',
        'city',
        'neighborhood',
        'latitude',
        'longitude',
        'status',
        'owner_name',
        'owner_phone',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'area' => 'decimal:2',
        'length' => 'decimal:2',
        'width' => 'decimal:2'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
