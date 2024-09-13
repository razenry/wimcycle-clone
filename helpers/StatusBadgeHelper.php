<?php

class StatusBadgeHelper
{
    public static function getStatusBadge($status)
    {
        $btn = 'white';
        $statusClass = '';

        switch ($status) {
            case 'Menunggu tanggapan':
                $btn = 'secondary';
                $statusClass = 'secondary';
                break;
            case 'Diverifikasi':
                $btn = 'info';
                $statusClass = 'info';
                break;
            case 'Dalam tindakan':
                $btn = 'warning';
                $statusClass = 'warning';
                break;
            case 'Tuntas':
                $btn = 'success';
                $statusClass = 'success';
                break;
            case 'Ditolak':
                $btn = 'danger';
                $statusClass = 'danger';
                break;
        }

        return "<span class='badge bg-$btn'>$status</span>";
    }

    public static function getStatusUser($status)
    {
        $badgeColor = $status == "1" ? "success" : "danger";
        $statusLabel = $status == "1" ? "Aktif" : "Non-Aktif";

        return "<span class='badge bg-$badgeColor'>$statusLabel</span>";
    }

    public static function getCompletionNotification($status)
    {
        $icon = '';
        $title = '';
        $statusClass = '';

        switch ($status) {
            case 'Menunggu tanggapan':
                $icon = '<i class="bi bi-hourglass-split text-secondary"></i>';
                $title = 'Menunggu Tanggapan';
                $statusClass = 'secondary';
                break;
            case 'Diverifikasi':
                $icon = '<i class="bi bi-check-circle text-info"></i>';
                $title = 'Laporan Diverifikasi';
                $statusClass = 'info';
                break;
            case 'Dalam tindakan':
                $icon = '<i class="bi bi-gear-fill text-warning"></i>';
                $title = 'Dalam Tindakan';
                $statusClass = 'warning';
                break;
            case 'Tuntas':
                $icon = '<i class="bi bi-award-fill text-success"></i>';
                $title = 'Laporan Selesai';
                $statusClass = 'success';
                break;
            case 'Ditolak':
                $icon = '<i class="bi bi-x-circle-fill text-danger"></i>';
                $title = 'Laporan Ditolak';
                $statusClass = 'danger';
                break;
            default:
                return '';
        }

        return "
            <div class='col-12'>
                <div class='card card-status $statusClass'>
                    <div class='card-body text-center'>
                        <h5 class='card-title'>$icon $title</h5>
                        <p class='card-text'>" . self::getStatusMessage($status) . "</p>
                    </div>
                </div>
            </div>
        ";
    }

    private static function getStatusMessage($status)
    {
        switch ($status) {
            case 'Menunggu tanggapan':
                return 'Laporan ini sedang menunggu tanggapan. Harap tunggu untuk tindakan lebih lanjut.';
            case 'Diverifikasi':
                return 'Laporan ini telah diverifikasi dan akan segera ditindaklanjuti.';
            case 'Dalam tindakan':
                return 'Laporan ini sedang dalam proses tindakan. Harap pantau perkembangan lebih lanjut.';
            case 'Tuntas':
                return 'Laporan ini telah dianggap selesai dan tidak memerlukan tindakan lebih lanjut.';
            case 'Ditolak':
                return 'Laporan ini telah ditolak. Anda dapat menghubungi kami untuk informasi lebih lanjut.';
            default:
                return '';
        }
    }

    public static function getStatusInfo($status, $date, $role = "Petugas")
    {
        $statusClass = '';
        $iconClass = '';
        $statusText = '';

        switch ($status) {
            case 'Menunggu tanggapan':
                $statusClass = 'text-gray-600';
                $iconClass = 'fas fa-dot-circle';
                $statusText = 'Menunggu';
                break;
            case 'Diverifikasi':
                $statusClass = 'text-blue-600';
                $iconClass = 'fas fa-dot-circle';
                $statusText = 'Diverifikasi';
                break;
            case 'Dalam tindakan':
                $statusClass = 'text-yellow-600';
                $iconClass = 'fas fa-dot-circle';
                $statusText = 'Dalam tindakan';
                break;
            case 'Tuntas':
                $statusClass = 'text-green-600';
                $iconClass = 'fas fa-dot-circle';
                $statusText = 'Tuntas';
                break;
            case 'Ditolak':
                $statusClass = 'text-red-600';
                $iconClass = 'fas fa-dot-circle';
                $statusText = 'Ditolak';
                break;
            default:
                $statusClass = 'text-gray-600';
                $iconClass = 'fas fa-dot-circle';
                $statusText = 'Unknown';
                break;
        }

        return "
            <div class='flex flex-row gap-2 my-2'>
                <div class='pt-1 md:flex md:justify-center'>
                    <i class=' . $statusClass $iconClass . '></i>
                </div>
                <div class=''>
                    <p class='font-medium $statusClass status-disposisi'>$statusText</p>
                    <p class='pb-1 text-sm text-gray-400'>
                        " . DateHelper::formatIndonesianDate($date) . "
                    </p>
                    <p class='pb-1 text-xs font-semibold text-gray-400'>
                        $role
                    </p>
                </div>
            </div>
        ";
    }

    public static function getVisibilityBadge($jenisLaporan)
    {
        $badgeClass = '';
        $text = '';

        switch ($jenisLaporan) {
            case 'anonim':
                $badgeClass = 'bg-gray-100 text-gray-600';
                $text = 'Anonim';
                break;
            case 'rahasia':
                $badgeClass = 'bg-yellow-100 text-yellow-600';
                $text = 'Rahasia';
                break;
            case 'publik':
                $badgeClass = 'bg-green-100 text-green-600';
                $text = 'Publik';
                break;
            default:
                $badgeClass = 'bg-gray-100 text-gray-600';
                $text = 'Unknown';
                break;
        }

        return "
            <div class='col-span-1 justify-self-end'>
                <span class='px-2 py-1 text-sm $badgeClass rounded-full'>$text</span>
            </div>
        ";
    }

    public static function getStatusBadgeTail($status)
    {
        $badgeClass = '';

        switch ($status) {
            case 'Menunggu':
                $badgeClass = 'bg-gray-600 text-white';
                break;
            case 'Diverifikasi':
                $badgeClass = 'bg-blue-600 text-white';
                break;
            case 'Dalam tindakan':
                $badgeClass = 'bg-yellow-600 text-white';
                break;
            case 'Tuntas':
                $badgeClass = 'bg-green-600 text-white';
                break;
            case 'Ditolak':
                $badgeClass = 'bg-red-600 text-white';
                break;
            default:
                $badgeClass = 'bg-gray-600 text-white';
                break;
        }

        return "<span class='inline-block px-2 py-1 mt-1 text-xs font-medium rounded-full $badgeClass'>Status: $status</span>";
    }

}
