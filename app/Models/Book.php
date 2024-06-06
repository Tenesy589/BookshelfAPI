<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'published_at',
    ];

    public function authors(): belongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }
}
