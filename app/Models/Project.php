<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    use HasFactory; 
    
    protected $fillable = [
        'name',
        'slug',
        'type_id',
        'file'
    ];

    // Relationships

    public function type()
    {
        return $this->belongsTo(Type::class);
        // non c'è bisogno di importarmi il model Type perchè insieme al Model Project si trovano nello stesso namespace
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class)
                    ->withTimestamps();
        // non c'è bisogno di importarmi il model Type perchè insieme al Model Project si trovano nello stesso namespace
    }
  
}
