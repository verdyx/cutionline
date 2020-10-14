<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $dates = [
        'tmt_cpns',
    ];

    /**
     * Get the employee's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->user->name;
    }

    /**
     * Get the employee's first username.
     *
     * @param  string  $value
     * @return string
     */
    public function getUsernameAttribute()
    {
        return $this->user->username;
    }

    /**
     * Get the user for the employee.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the boss for the employee.
     */
    public function boss()
    {
        return $this->belongsTo(Employee::class, 'boss_id');
    }

    /**
     * Get the employee for the employee.
     */
    public function employees()
    {
        return $this->hasMany(Employee::class, 'boss_id', 'id');
    }
}
