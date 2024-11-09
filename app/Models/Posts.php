<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Posts extends Model
{

    protected $fillable = [
        'title', 'content', 'userid'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');    
    }

    protected static function booted()
    {
        static::creating(function ($post) {
            if (!$post->id) {
                $post->id = (string) Str::uuid();
            }
        });
    }
}
