<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $guarded = [];

    public function companyR()
    {
        return $this->belongsTo('App\Models\Company', 'company', 'id');
    }
}
