<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function Movie()
    {
        return $this->hasMany('App\Models\admin\Movie', 'id_category');
    }
}
