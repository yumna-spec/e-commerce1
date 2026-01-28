<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
#[ObservedBy(ProductObserver::class)]
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

// protected $primaryKey = 'id';
// protected $guarded = ['id'];
    
 protected $casts= [
     'Is_trend'=>'boolean',
 ];


    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'category_id',
        'Is_trend',
        'category_name',
        'image'
        
    ];


    public function users(){
        return $this->belongsToMany(User::class,'cart')->withPivot('quantity')->withTimestamps();
        
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