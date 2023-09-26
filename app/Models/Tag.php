<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = "tags";
    protected $guarded = [];
    public function artikel()
    {
        return $this->belongsTo(Artikel::class, '[post_id', 'id');
    }

}
