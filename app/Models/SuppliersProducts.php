<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliersProducts extends Model
{
    protected $fillable = ['product_id', 'supplier_id', 'price'];

    use HasFactory;
}
