<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'profile_image',
        'bio',
    ];

    public function tools()
    {
        return $this->belongsToMany(Tool::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
