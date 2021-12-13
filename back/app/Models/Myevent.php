<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Myevent extends Model
{
    use HasFactory;
    protected $fileable =
    ['category_id',
     'user_id',
     'title', 
     'start_date', 
     'end_date', 
     'city', 
     'description', 
     'photo',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function userjoinevent() {
        return $this->hasMany(UserJoinEvent::class);
    }
}