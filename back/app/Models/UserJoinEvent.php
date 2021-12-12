<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJoinEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'myevents_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function myevent() {
        return $this->belongsTo(Myevent::class);
    }
}
