<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'job_title',
        'city',
        'status',
        'slug',
        'user_id',
        'company_id',
    ];

    public $timestamps = false;

    protected static function booted(): void
    {
        static::creating(function ($object) {
            $object->user_id = 1;
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'job_title',
            ]
        ];
    }


}
