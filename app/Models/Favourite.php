<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function price(){
        return $this->belongsTo(Price::class,'product_id','product_id');
    }
}
