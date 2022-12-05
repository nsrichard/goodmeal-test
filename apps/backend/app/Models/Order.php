<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\OrderHistory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function detail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function history()
    {
        return $this->hasMany(OrderHistory::class);
    }
}
