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
}
