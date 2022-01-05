<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded= ['id'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function market(){
        return $this->belongsTo(Market::class);
    }

    public function orderDetail(){
        return $this->hasMany(OrderDetail::class);
    }

    public function comment(){
        return $this->hasOne(Comment::class);
    }
}
