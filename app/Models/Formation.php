<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'status',
        'archive',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'id_formation'); 
    }
}
