<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function main(){
        return $this->belongsTo(Main_category::class,'main_category_id');
    }
    public function sub(){
        return $this->belongsTo(Sub_category::class,'sub_category_id');
    }
    public function tiny(){
        return $this->belongsTo(Tiny_category::class,'tiny_category_id');
    }
    public function price(){
        return $this->hasOne(Price::class);
    }
    public function prices(){
        return $this->hasMany(Price::class);
    }
}
