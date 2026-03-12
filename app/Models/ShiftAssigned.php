<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftAssigned extends Model
{
    protected $table = 'shift_assigned';

    public $timestamps = false;

    protected $fillable = [
        'site_id',
        'site_name',
        'shift_id',
        'shift_name',
        'shift_time',
        'client_id',
        'supervisor_id',
        'company_id'
    ];
}
