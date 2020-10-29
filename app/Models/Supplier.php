<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['company_name', 'tranding_name', 'cnpj', 'address_1', 'address_2', 'telephone_1', 'telephone_2'];

    public function supplier_products()
    {
        return $this->belongsToMany('App\Model\Product');
    }

    use HasFactory;
}
