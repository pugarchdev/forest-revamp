<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteDetail extends Model
{
    protected $table = 'site_details';

    protected $fillable = [
        'name',
        'address',
        'state',
        'city',
        'pincode',
        'contactPerson',
        'mobile',
        'sosContact',
        'email',
        'earlyTime',
        'lateTime',
        'siteType',
        'client_id',
        'client_name',
        'company_id'
    ];
}
