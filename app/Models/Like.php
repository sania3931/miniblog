<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = 'likes';
    protected $fillable = ['id_user', 'id_post' ];
    public $timestamps = false;
    // public function artikel()
    // {
    //     return $this->belongsTo(Artikel::class, 'post_id', 'id');
    // }
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
}
