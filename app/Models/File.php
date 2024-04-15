<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'type',
        'post_id',
        'user_id',
    ];

    public $timestamps = false;
    protected static function booted(): void
    {
        static::creating(function ($object) {
            $object->user_id = 1;
        });

    }
}
