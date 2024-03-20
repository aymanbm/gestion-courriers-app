<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ["created_at"];
    protected $fillable = [
        'nom',
        'email',
        'password',
        'statue',
        'image',
    ];

    //bindname
    public function getRouteKeyName(){
        return 'id';
    }

    // public function getImageAttribute($value){
    //     return $value??'profile/no.jpg';
    // }
}
