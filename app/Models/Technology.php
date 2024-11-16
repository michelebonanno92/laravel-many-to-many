<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

     // Relationships

     public function projects()
     {
         return $this->belongsToMany(Project::class)
                      ->withTimestamps();

         // non c'è bisogno di importarmi il model Type perchè insieme al Model Project si trovano nello stesso namespace
     }

}
