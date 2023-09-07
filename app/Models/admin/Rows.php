<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rows extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rows';

    protected $fillable = [
        'name',
        'id_room',
        'user_id',
    ];

    public function Seats()
    {
        return $this->hasMany('App\Models\admin\Seats', 'id_row');
    }
}
