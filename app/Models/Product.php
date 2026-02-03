<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
#[ObservedBy(ProductObserver::class)]
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    public array $translatable = ['name','description'];

// protected $primaryKey = 'id';
// protected $guarded = ['id'];
protected $translate=['country'];


//  protected $casts= [
//      'Is_trend'=>'boolean',
//      'name'=>'array',
//      'description'=>'array'
//  ];


 

    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'category_id',
        'Is_trend',
        'category_name',
        'image',
        
        
    ];


    public function users(){
        return $this->belongsToMany(User::class,'cart')->withPivot('quantity')->withTimestamps();
        
        }

        public function scopeSearch($query, $search )
    {
    
       return $query->where('name->en','like',"%$search%")
       ->orWhere('name->ar','like',"%$search%")
       
                    ->orWhere('description','like',"%$search%");
    }


    

    public function orderItems(){
        return $this->hasMany(OrderItems::class);
    }

    public function categories(){
        return $this->belongsTo(Category::class);
    }

}