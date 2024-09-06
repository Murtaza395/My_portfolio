<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function profile(){
        return $this->belongsTo(\App\Models\Profile::class);
    }
    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }
    public function comment(){
        return $this->hasmany(Comment::class);
    }
    use HasFactory;
}
