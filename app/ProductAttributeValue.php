<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    use HasFactory;

    protected $table='product_attribute_values';

    public function product()
    {
        //return $this->hasMany('App\Models\Accounts\Ledger');
        return $this->belongsTo(Product::class,'product_id','id' );
        //return $this->hasMany(UsersLogin::class, 'user_id', 'id');
    }
}