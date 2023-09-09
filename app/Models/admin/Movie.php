<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'movie';

    public function Categories()
    {
        return $this->belongsTo('App\Models\admin\Categories', 'id_category');
    }

    protected $fillable = [
        'id',
        'name',
        'start_date',
        'trailer',
        'image',
        'age_limit',
        'time',
        'description',
        'id_category',
        'user_id',
    ];
}
