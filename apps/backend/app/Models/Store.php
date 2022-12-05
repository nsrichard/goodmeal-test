<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\StoreOpening;

class Store extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fillAndSave($data)
    {
        $this->fill($data);
        return $this->save();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function openings()
    {
        return $this->hasMany(StoreOpening::class);
    }
}
