<?php
// app/Http/Controllers/CalendarController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function show($month = null, $year = null)
    {
        $date = Carbon::now();

        // Ja mēnesis vai gads nav norādīts, izmanto pašreizējo datumu
        if ($month && $year) {
            $date = Carbon::createFromDate($year, $month, 1);
        }

        // Aprēķinām nepieciešamos datus
        $daysInMonth = $date->daysInMonth;
        $monthName = $date->format('F');
        $year = $date->year;
        $month = $date->month; // Pievieno šo rindu, lai definētu $month

        $previousMonth = $date->copy()->subMonth()->month;
        $nextMonth = $date->copy()->addMonth()->month;

        return view('calendar', compact('daysInMonth', 'monthName', 'year', 'month', 'previousMonth', 'nextMonth'));
    }
}