<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $table = "artikels";
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function tag()
    {
        return $this->hasMany(Tag::class, 'post_id', 'id');
    }
    public function like()
    {
        return $this->hasMany(Like::class, 'post_id', 'id');
    }
}
