<?php 

namespace App\Helpers;

use Carbon\Carbon;
class DateHelper {
    public static function convertToDateFormat($date)
    {
        $date = Carbon::createFromFormat('d/m/Y', $date);
        return Carbon::parse($date)->format('Y-m-d');
    }
    public static function convertToTimeFormat($time)
    {
        $time = Carbon::createFromTimeString($time);
        return Carbon::parse($time)->format('H:i:s');
    }

}
?>