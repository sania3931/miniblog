<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $guarded = [];
    public function children()
    {
        return $this->hasMany(Category::class, 'cat_parent_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'cat_parent_id', 'id');
    }
    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'category_id', 'id');
    }

}
