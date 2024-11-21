<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;

    protected $primaryKey = "movie_id";

    protected $fillable = [
        'title',
        'price',
        'release_date',
        'synopsis',
        'rating_fk',
        'cover'
    ];

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'rating_fk', 'rating_id');
    }

    public function getImage()
    {
        return asset('storage/'.$this->cover);
    }

}
