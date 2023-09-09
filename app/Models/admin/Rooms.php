<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rooms extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'id_theater',
        'seat_qty',
        'seats',
        'user_id',
    ];

    public function Showtime()
    {
        return $this->hasMany('App\Models\admin\Showtime', 'id_room');
    }

    public function Theaters()
    {
        return $this->belongsTo('App\Models\admin\Theaters', 'id_theater');
    }
}
