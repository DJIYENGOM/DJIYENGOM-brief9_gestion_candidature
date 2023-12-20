<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_formation',
        'validation',
        'archive',
    ];

    public function candidatures()
    {
        return $this->hasMany(Formation::class);
    }

  
    public function formation()
    {
        return $this->belongsTo(Formation::class, 'id_formation'); 
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}

