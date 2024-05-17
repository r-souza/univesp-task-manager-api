<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Status extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    *@var array
    */
    protected $fillable = [
        'name',
        'description'
    ];

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
