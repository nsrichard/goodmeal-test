<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\StoreOpening;
use Carbon\Carbon;

use App\Helpers\Misc;

class Store extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['updated_at'];

    protected $dates = ['created_at', 'updated_at'];

    protected $appends = ['FromPrice', 'FromOldPrice', 'Opening', 'ServiceName', 'TotalProducts', 'Distance'];

    public function fillAndSave($data)
    {
        $this->fill($data);
        return $this->save();
    }

    public function getFromPriceAttribute()
    {
        $product = $this->products()->orderBy('price', 'desc')->first();
        if (!$product) return 0;
        return $product->price - ($product->price * $product->discount / 100);
    }

    public function getFromOldPriceAttribute()
    {
        $product = $this->products()->orderBy('price', 'desc')->first();
        if (!$product) return 0;
        return $product->price;
    }

    public function getTotalProductsAttribute()
    {
        return $this->products()->count();
    }

    public function getOpeningAttribute()
    {
        return $this->openings()->where('weekday', Carbon::now()->dayOfWeek)->first();
    }

    public function getServiceNameAttribute()
    {
        if ($this->service == 'store'){
            return "Retiro en local";
        } else if ($this->service == 'delivery'){
            return "Delivery";
        }
        return "Retiro o Delivery"; 
    }

    public function getDistanceAttribute()
    {
        // assuming we are in Santiago de Chile
        $currentLat = -33.4727879;
        $currentLng = -70.6298313;
        return round(Misc::distance($currentLat, $currentLng, $this->lat, $this->lng), 2);
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
