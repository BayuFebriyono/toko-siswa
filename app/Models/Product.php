<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $with = ['market', 'photo'];
    public $table = "products";
    protected $guarded = ['id'];

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function photo()
    {
        return $this->hasMany(Photo::class);
    }
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
