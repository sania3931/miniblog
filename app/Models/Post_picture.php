<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_picture extends Model
{
    use HasFactory;
    protected $table = "post_pictures";
    protected $guarded = [];
}
