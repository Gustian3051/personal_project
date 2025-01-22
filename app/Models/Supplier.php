<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'address',
        'shop_name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
