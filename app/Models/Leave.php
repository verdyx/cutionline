<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $dates = [
        'from_date',
        'to_date',
    ];

    /**
     * Get the employee for the leave.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
