<?php

namespace App;

use Carbon\Carbon;

class Date
{
    /**
     * get date format according to our need
     */
    public static function getDate($date)
    {
        $date = new Carbon($date);
        $date = $date->format('d/m/Y');
        return $date;
    }

    /**
     * get date format for database
     */
    public static function setDate($date)
    {
        $date = Carbon::createFromFormat('d.m.Y',$date)->format('Y-m-d');
        return $date;
    }
}
