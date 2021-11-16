<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table='products';

    public function ratings() {
        return $this->hasMany(ProductReview::class, 'id', 'product_id');

    }
    public function images() {
        return $this->belongsTo(ProductImage::class, 'id', 'product_id');

    }

    public function attributes() {
        return $this->hasMany(ProductAttributeValue::class, 'product_id', 'id');

    }


}