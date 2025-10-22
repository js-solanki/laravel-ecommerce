<?php

use Carbon\Carbon;

if (!function_exists('getFormattedTime')) {
    function getFormattedTime($time)
    {
        $time = Carbon::parse($time);

        if ($time->isToday()) {
            return $time->format('h:i A');
        } elseif ($time->isYesterday()) {
            return 'Yesterday at ' . $time->format('h:i A');
        } elseif ($time->greaterThan(Carbon::now()->subDays(7))) {
            return $time->format('l \a\t h:i A');
        } else {
            return $time->format('M d, h:i A');
        }
    }
}