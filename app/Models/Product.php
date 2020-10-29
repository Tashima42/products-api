<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function supplier_products()
    {
        return $this->belongsToMany('App\Model\SuppliersProducts');
    }

    use HasFactory;
}
