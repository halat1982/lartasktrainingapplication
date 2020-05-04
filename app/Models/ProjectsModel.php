<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectsModel extends Model
{
    protected $table = 'projects';
    public $timestamps = false;
    protected $fillable = [
        'reg_num',
        'title',
        'alias',
        'description',
        'manager_id',
        'register_date'
    ];

    public function employee()
    {
        return $this->hasOne(EmployeeModel::class, 'id', 'manager_id');
    }

    public function task()
    {
        return $this->hasMany('App\Models\TaskModel', 'project_id', 'id');
    }
}
