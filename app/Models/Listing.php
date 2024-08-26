<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model {

    use HasFactory;
    protected $fillable = ['country', 'state', 'city', 'location', 'category_id', 'sub_category_id', 'user_id', 'company', 'phone', 'services', 'gallery', 'ft_image', 'status'];

    // Relationship with Category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Relationship with SubCategory
    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }

    // Relationship with User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relationship with Reviews
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    // Method to calculate average rating
    public function averageRating(){
        return $this->reviews()->avg('rating');
    }

}
