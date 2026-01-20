<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["name","parent_id"];   
    
    

    
    public function products(){
        return $this->hasMany(Product::class);
    } 

    public function parentcat()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function scopeFather($query){
        return $query->wherenotnull('parent_id');
    }
    //
}
