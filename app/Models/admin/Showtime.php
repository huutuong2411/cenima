<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Showtime extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'showtime';

    public function Movie()
    {
        return $this->belongsTo('App\Models\admin\Movie', 'id_movie');
    }

    public function Rooms()
    {
        return $this->belongsTo('App\Models\admin\Rooms', 'id_room');
    }

    protected $fillable = [
        'id',
        'name',
        'id_room',
        'id_movie',
        'start_at',
        'end_at',
        'date',
        'price',
        'user_id',
    ];
}
