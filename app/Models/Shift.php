<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shifts';

    public $timestamps = false;

    protected $fillable = [
        'shift_name',
        'shift_time',
        'supervisor_id',
        'company_id'
    ];
}
