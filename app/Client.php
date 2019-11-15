<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $connection = 'mysql2';
    protected $table = 'companies';

    public function timesheets()
    {
        return $this->hasMany('App\Timesheet');
    }
}
