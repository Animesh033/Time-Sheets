<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    //
    protected $fillable = [
    	'user_id',
        'datesheet_id',
        'client_id',
        'working_hrs',
        'working_mins',
    ];

    public function datesheet()
    {
        return $this->belongsTo('App\Datesheet');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

}
