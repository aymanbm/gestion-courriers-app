<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lieudestinateur extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'adresse',

    ];
    public function isAdmin(){
        return $this->statue === "admin";
    }

}
