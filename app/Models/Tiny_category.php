<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiny_category extends Model
{
    use HasFactory;
    public function subCategory(){
        return $this->belongsTo(Sub_category::class);
    }
    public function mainCategory(){
        return $this->belongsTo(Main_category::class);
    }
}
