<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Json;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'title',
        'slug',
        'property_type',
        'bedrooms',
        'bathrooms',
        'area',
        'property_tag',
        'brocker_image',
        'location',
        'sub_title',
        'complition_status',
        'property_review_link',
        'agent_slug',
        'company_slug',
        'amenities',
        'property_description',
        'is_verified',
        'property_references',
        'sale_type',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'complition_status' => Json::class,
        'property_description' => Json::class,
        'property_references' => Json::class,
    ];
}
