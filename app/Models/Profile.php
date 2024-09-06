<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
