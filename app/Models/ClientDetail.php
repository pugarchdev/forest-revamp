<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientDetail extends Model
{
    protected $table = 'client_details';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'contact',
        'email',
        'spokesperson',
        'address',
        'company_id',
        'state',
        'city',
        'pincode',
        'relationManager',
        'relationManagerContact',
        'isActive'
    ];
}
