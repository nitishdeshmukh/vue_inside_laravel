<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['title', 'publication_date', 'description','author'];

    public function scopePostTitle($query, $value)
    {
        $query->where(function ($query) use ($value) {
            $query->where('posts.title', 'like', '%' . $value . '%');
        });
    
        return $query;
    }

    public function scopePostAuthor($query, $value)
    {
        $query->where(function ($query) use ($value) {
            $query->where('posts.author', 'like', '%' . $value . '%');
        });
    
        return $query;
    }

    public function scopePostId($query, $value)
    {
        $query->where(function ($query) use ($value) {
            $query->where('posts.id', 'like', '%' . $value . '%');
        });
    
        return $query;
    }

    public function scopePostPublicationDate($query, $value)
    {
        $query->where(function ($query) use ($value) {
            $query->where('posts.publication_date', 'like', '%' . $value . '%');
        });
    
        return $query;
    }

    public function scopeSearchAnyThing($query, $value)
    {
        $query->where(function ($query) use ($value) {
            $query->where('posts.publication_date', 'like', '%' . $value . '%')
            ->orWhere('posts.title', 'like', '%' . $value . '%')
            ->orWhere('posts.author', 'like', '%' . $value . '%')
            ->orWhere('posts.id', 'like', '%' . $value . '%');
        });
    
        return $query;
    }
}
