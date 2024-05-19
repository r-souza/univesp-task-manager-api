<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Task extends Model implements Auditable
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
        'description',
        'completed',
        'priority_id',
        'project_id',
        'status_id',
        'user_id',
        'effective_duration'
    ];

    public function priority()
    {
        return $this->belongsTo('App\Models\Priority');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
