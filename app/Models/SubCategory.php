<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model{

    use HasFactory;
    protected $fillable = ['title', 'category_id'];

    // Relationship with Category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Relationship with Listing
    public function listings(){
        return $this->hasMany(Listing::class);
    }

}
