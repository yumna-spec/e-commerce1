<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'category_id',
        'Is_trend',
        'category_name',
        
    ];


    public function users(){
        return $this->belongsToMany(User::class,'cart')->withPivot('quantity');
        
        }

        public function scopeSearch($query, $search )
    {
       return $query->where('name','like',"%$search%")
                    ->orWhere('description','like',"%$search%");
    }

    public function orderItems(){
        return $this->hasMany(OrderItems::class);
    }

    public function categories(){
        return $this->belongsTo(Category::class);
    }

}