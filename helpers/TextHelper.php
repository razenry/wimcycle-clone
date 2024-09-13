<?php

class TextHelper
{
    public static function limitText($text, $maxLength = 30, $encoding = 'UTF-8')
    {
        // Cek apakah teks melebihi batas maksimal
        if (mb_strlen($text, $encoding) > $maxLength) {
            // Potong teks dan tambahkan ellipsis (tanda tiga titik) di akhir
            return mb_substr($text, 0, $maxLength, $encoding) . '...';
        }
        return $text;
    }

    public static function capitalizeFirstLetter($string) {
        // Fungsi ucwords untuk mengubah huruf pertama dari setiap kata menjadi kapital
        return ucwords(strtolower($string));
    }

}