<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Posts; 

class Category extends Model
{
    protected $keyType = 'string';

    protected $fillable = [
        'name',
    ];


    public function posts()
    {
        return $this->hasMany(Posts::class, 'categoryid', 'id');
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
