<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteAssign extends Model
{
    use HasFactory;

    protected $table = 'site_assign';

    protected $fillable = [
        'company_id',
        'user_id',
        'user_name',
        'supervisor_id',
        'client_id',
        'client_name',
        'site_id',
        'site_name',
        'shift_id',
        'shift_name',
        'shift_time',
        'shift_start',
        'shift_end',
        'startDate',
        'endDate',
        'weekoff',
        'role_id'
    ];

    protected $casts = [
        'startDate' => 'date',
        'endDate' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function client()
    {
        return $this->belongsTo(ClientDetail::class, 'client_id');
    }

    public function site()
    {
        return $this->belongsTo(SiteDetail::class, 'site_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}
