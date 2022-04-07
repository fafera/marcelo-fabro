<?php 

namespace App\Helpers;

use Carbon\Carbon;
class DateHelper {
    public static function convertToDateFormat($date)
    {
        if(str_contains($date, '/')) {
            $date = Carbon::createFromFormat('d/m/Y', $date);
            return Carbon::parse($date)->format('Y-m-d');
        }
        return $date;
    }
    public static function covertToBRDateFormat($date) {
        if(strpos($date, '/') === false) {
            $date = Carbon::createFromFormat('Y-m-d', $date);
            return Carbon::parse($date)->format('d/m/Y');
        }
        return $date;
    }
    public static function convertToTimeFormat($time)
    {
        $time = Carbon::createFromTimeString($time);
        return Carbon::parse($time)->format('H:i:s');
    }
    public static function convertToBRTimeFormat($time)
    {
        return Carbon::parse($time)->format('H:i');
    }

}
?>