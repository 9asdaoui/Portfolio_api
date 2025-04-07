<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'project_url',
        'type',
    ];

    /**
     * Get the tools associated with the project.
     */
    public function tools()
    {
        return $this->belongsToMany(Tool::class, 'project_tools');
    }
}
