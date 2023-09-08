<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theaters extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'theaters';

    protected $fillable = [
        'name',
        'address',
        'id_city',
        'user_id',
    ];

    public function Rooms()
    {
        return $this->hasMany('App\Models\admin\Rooms', 'id_theater');
    }

    public function Cities()
    {
        return $this->belongsTo('App\Models\admin\City', 'id_city');
    }
}
