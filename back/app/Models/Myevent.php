<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Myevent extends Model
{
    use HasFactory;
    protected $fillable = ['title','start_date','end_date','description'];
    // public function getStartDateAttribute($value){
    //     return Carbon::parse($value)->format('D, j M Y h:i A');
    // }
}
