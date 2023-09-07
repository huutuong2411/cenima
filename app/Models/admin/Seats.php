<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seats extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'seats';

    protected $fillable = [
        'name',
        'id_row',
        'id_column',
        'user_id',
    ];
}
