<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_url',
    ];

    /**
     * Get the projects associated with the tool.
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_tools');
    }
}
