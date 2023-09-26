<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";
    protected $guarded = [];
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }
    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'post_id', 'id');
    }
}
