<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

     public function transalation() {
        return $this->belongsTo(CategoryTranslation::class, 'id', 'category_id');

    }
}