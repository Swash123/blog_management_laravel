<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'replied_to');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'replied_to');
    }

    public function countChildren()
    {
        return $this->children()->count();
    }
}
