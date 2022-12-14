<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Store;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fillAndSave($data)
    {
        $this->fill($data);
        return $this->save();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
