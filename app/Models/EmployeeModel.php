<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees';
    public $timestamps = false;
    protected $fillable = [
        'reg_num',
        'last_name',
        'first_name',
        'second_name',
        'position',
        'birthday_date',
        'email',
        'phone'
    ];
}
