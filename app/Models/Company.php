<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $guarded = [];

    public function employees()
    {
        return $this->hasMany('App\Models\Employee', 'id');
    }

    public function logoImage()
    {
        return $this->hasOne('App\Models\Upload', 'id', 'logo');
    }
}
