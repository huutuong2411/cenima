<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'order';

    protected $fillable = [
        'id',
        'user_id',
        'id_showtime',
        'ticket',
        'total',
    ];

    public function Showtime()
    {
        return $this->belongsTo('App\Models\admin\Showtime', 'id_showtime');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
