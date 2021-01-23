<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    use HasFactory;
    public function mainCategory(){
        return $this->belongsTo(Main_category::class);
    }
    
}
