<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
    protected $table = 'bobots';

    protected $fillable = [
        'kriteria',
        'bobot',
    ];
}
