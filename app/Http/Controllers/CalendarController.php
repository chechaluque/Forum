<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CalendarController extends Controller
{
    public function crear()
    {
    	$title = $_POST['title'];
    	$start = $_POST['start'];
    	$back = $_POST['background'];

    	$evento = new Fullcalendar;

    	$evento->fechaStart = $start;
    	//$evento->fechaEnd = $end;
    	$evento->allDay = true;
    	$evento->color = $back;
    	$evento->title = $title;
    }
}
