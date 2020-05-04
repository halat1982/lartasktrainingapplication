<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeesTasksModel extends Model
{
    protected $table = 'employees_models';
    public $timestamps = false;
    protected $fillable = [
        'employee_id',
        'task_id'
    ];
}
