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
}
