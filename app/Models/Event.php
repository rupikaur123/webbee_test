<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    public function workshops()
    {
        return $this->hasMany(Workshop::class,'event_id','id');
    }

    public function futureWorkshops()
    {
        return $this->hasMany(Workshop::class,'event_id','id')->whereDate('start', '>', now()->format('Y-m-d H:i:s'));
    }
}
