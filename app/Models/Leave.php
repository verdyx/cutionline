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
     * Get the user for the leave.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function signature()
    {
        return $this->belongsTo(User::class, 'signature_id');
    }
}
