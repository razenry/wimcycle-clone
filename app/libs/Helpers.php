<?php

class TextHelper
{
    public static function limitText($text, $maxLength = 50, $encoding = 'UTF-8')
    {
        // Cek apakah teks melebihi batas maksimal
        if (mb_strlen($text, $encoding) > $maxLength) {
            // Potong teks dan tambahkan ellipsis (tanda tiga titik) di akhir
            return mb_substr($text, 0, $maxLength, $encoding) . '...';
        }
        return $text;
    }
}

class StatusButtonHelper
{
    public static function getStatusButton($status)
    {
        $btn = 'white';

        switch ($status) {
            case 'Menunggu':
                $btn = 'secondary';
                break;
            case 'Diverifikasi':
                $btn = 'info';
                break;
            case 'Dalam tindakan':
                $btn = 'warning';
                break;
            case 'Tuntas':
                $btn = 'success';
                break;
            case 'Ditolak':
                $btn = 'danger';
                break;
        }

        return "<button type='button' class='btn btn-$btn btn-sm'>$status</button>";
    }
}


class StatusBadgeHelper
{
    public static function getStatusBadge($status)
    {
        $btn = 'white';

        switch ($status) {
            case 'Menunggu':
                $btn = 'secondary';
                break;
            case 'Diverifikasi':
                $btn = 'info';
                break;
            case 'Dalam tindakan':
                $btn = 'warning';
                break;
            case 'Tuntas':
                $btn = 'success';
                break;
            case 'Ditolak':
                $btn = 'danger';
                break;
        }

        return "<span class='badge bg-$btn'>$status</span>";
    }

    public static function getStatusUser($status)
    {
        // Map the status to a corresponding badge color and label
        $badgeColor = $status == "1" ? "success" : "danger";
        $statusLabel = $status == "1" ? "Aktif" : "Non-Aktif";

        // Return the HTML string with the appropriate badge and status label
        return "<span class='badge bg-$badgeColor'>$statusLabel</span>";
    }
}

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

    public static function formatIndonesianDate($dateString)
    {
        $date = new DateTime($dateString);
        return $date->format('d ') . self::getIndonesianMonth((int)$date->format('n')) . $date->format(' Y');
    }

    public static function formatTime($timeString)
    {
        $time = new DateTime($timeString);
        return $time->format('H:i');
    }
}

class ActionButtonHelper
{
    public static function getActionButtons($laporan)
    {
        $buttons = '<div class="text-end"><div class="d-grid gap-2 d-md-flex justify-content-md-end">';

        // Edit Status Button
        $buttons .= '<button class="btn btn-success w-100 w-md-auto me-2" data-bs-toggle="modal" data-bs-target="#statusModal">';
        $buttons .= '<i class="bi bi-pencil-square me-1"></i>Edit Status</button>';

        // Conditional buttons based on the report status
        if ($laporan['status'] == "Tuntas") {
            $buttons .= '<button class="btn btn-primary w-100 w-md-auto me-2" data-bs-toggle="modal" data-bs-target="#responseModal">';
            $buttons .= '<i class="bi bi-reply-fill me-1"></i>Beri Tanggapan</button>';
        }

        if ($laporan['status'] != "Tuntas" && $laporan['status'] != "Ditolak") {
            $buttons .= '<button class="btn btn-danger w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#rejectModal">';
            $buttons .= '<i class="bi bi-x-circle-fill me-1"></i>Tolak Laporan</button>';
        }

        // If status is "Ditolak", add a "Kembalikan Laporan" button
        if ($laporan['status'] == "Ditolak") {
            $buttons .= '<button class="btn btn-warning w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#restoreModal">';
            $buttons .= '<i class="bi bi-arrow-counterclockwise me-1"></i>Kembalikan Laporan</button>';
        }

        $buttons .= '</div></div>';

        return $buttons;
    }
}
