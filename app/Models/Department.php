<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'parent_id', 'name', 'alias', 'level',
    ];


    public function children()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function subDepartments()
    {
        return $this->children()->with('subDepartments');
    }
}
