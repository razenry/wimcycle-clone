<?php

class DateHelper
{
    public static function getIndonesianMonth($monthNumber)
    {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        return $months[$monthNumber];
    }

    public static function getIndonesianDay($dayNumber)
    {
        $days = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu'
        ];
        return $days[$dayNumber];
    }

    public static function formatIndonesianDate($dateString)
    {
        $date = new DateTime($dateString);
        $dayOfWeek = self::getIndonesianDay((int)$date->format('w'));
        return $dayOfWeek . ', ' . $date->format('d ') . self::getIndonesianMonth((int)$date->format('n')) . $date->format(' Y');
    }

    public static function formatIndonesianDay($dateString)
    {
        $date = new DateTime($dateString);
        return self::getIndonesianDay((int)$date->format('w'));
    }

    public static function formatTime($timeString)
    {
        $time = new DateTime($timeString);
        return $time->format('H:i');
    }

    // Set default timezone to Indonesian Time (WIB)
    public static function setIndonesianTimeZone($timezone = 'Asia/Jakarta')
    {
        date_default_timezone_set($timezone);
    }

    // Format datetime in Indonesian format (WIB by default)
    public static function formatIndonesianDateTime($datetime, $timezone = 'Asia/Jakarta')
    {
        self::setIndonesianTimeZone($timezone);
        return date('d F Y H:i:s', strtotime($datetime));
    }

    // Format time in Indonesian format (WIB by default)
    public static function formatIndonesianTime($time, $timezone = 'Asia/Jakarta')
    {
        self::setIndonesianTimeZone($timezone);
        return date('H:i:s', strtotime($time));
    }

    // Get timezone abbreviation (WIB, WITA, WIT)
    public static function getTimezoneAbbreviation($timezone = 'Asia/Jakarta')
    {
        switch ($timezone) {
            case 'Asia/Jakarta':
                return 'WIB'; // Western Indonesian Time
            case 'Asia/Makassar':
                return 'WITA'; // Central Indonesian Time
            case 'Asia/Jayapura':
                return 'WIT'; // Eastern Indonesian Time
            default:
                return 'Unknown';
        }
    }
}
