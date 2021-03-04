<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles_tables';
    public function getroleName()
    {
        return $this->hasOne('App\Models\Role');
    }
}
