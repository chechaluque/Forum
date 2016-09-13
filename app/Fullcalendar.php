<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fullcalendar extends Model
{
    protected $table= 'fullcalendars';
    protected $fillable = ['fechaStart', 'fechaEnd', 'allDay', 'color', 'title']
}
