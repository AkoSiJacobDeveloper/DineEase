<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';
    // protected $fillable = ['name','category_id', 'description', 'price', 'image'];
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
