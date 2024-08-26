<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    use HasFactory;
    protected $fillable = ['title', 'image'];

    // Relationship with SubCategory
    public function subCategories(){
        return $this->hasMany(SubCategory::class);
    }

    // Relationship with Listing
    public function listings(){
        return $this->hasMany(Listing::class);
    }

}
