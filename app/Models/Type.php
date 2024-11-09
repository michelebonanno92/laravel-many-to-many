<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug'
    ];

      // Relationships

      public function projects()
      {
          return $this->hasMany(Project::class);
          // non c'è bisogno di importarmi il model Project  perchè insieme al Model Type si trovano nello stesso namespace
      }
    
}
