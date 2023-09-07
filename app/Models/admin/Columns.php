<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Columns extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'columns';

    protected $fillable = [
        'name',
        'id_room',
        'user_id',
    ];

    public function Seats()
    {
        return $this->hasMany('App\Models\admin\Seats', 'id_column');
    }
}
