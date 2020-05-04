<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    public $timestamps = false;
    protected $fillable = [
        'project_id',
        'reg_num',
        'title',
        'description',
        'start_date',
        'finish_date',
        'rate_time',
        'status'
    ];

    public function employee()
    {
        return $this->hasOne('App\Models\EmployeeModel', 'manager_id');
    }
}
