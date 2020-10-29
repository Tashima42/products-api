<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliersProducts extends Model
{
    protected $fillable = ['product_id', 'supplier_id', 'price'];

    public function supplier()
    {
        return $this->hasMany('App\Model\Supplier');
    }

    public function product()
    {
        return $this->hasMany('App\Model\Product');
    }

    use HasFactory;
}
