<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courrier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'reference',
        'date_reçu',
        'date_envoyer',
        'destinateur',
        'lieu_destinateur',
        'objet',
        'commentaire',
        'courrier_statue',
        'files',
    ];
    public function isAdmin(){
        return $this->statue === "admin";
    }

    

}
