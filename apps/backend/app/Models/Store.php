<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\StoreOpening;
use Carbon\Carbon;

class Store extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['updated_at'];

    protected $dates = ['created_at', 'updated_at'];

    protected $appends = ['FromPrice', 'Opening'];

    public function fillAndSave($data)
    {
        $this->fill($data);
        return $this->save();
    }

    public function getFromPriceAttribute()
    {
        return $this->products()->min('price');
    }

    public function getOpeningAttribute()
    {
        return $this->openings()->where('weekday', Carbon::now()->dayOfWeek)->first();
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
