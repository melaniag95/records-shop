<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;

class Record extends Model
{
    use HasFactory;

    protected $table = 'records';
    protected $fillable = ['id', 'title', 'artist', 'genre_id', 'description', 'picture', 'year', 'price', 'tracklist', 'created_at', 'updated_at'];

    public function genre(){
        return $this->belongsTo(Genre::class);
    }
}
