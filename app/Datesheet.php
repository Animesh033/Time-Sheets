<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datesheet extends Model
{
    //
    protected $fillable = [
        'user_id',
        'break_hrs',
        'break_mins',
        'idle_hrs',
        'idle_mins',
        'leave_status',
        'sheet_date',
        'total_hrs',
        'total_mins'
    ];

    public function timesheets()
    {
        return $this->hasMany('App\Timesheet')->where('user_id', auth()->user()->id);
    }

}
