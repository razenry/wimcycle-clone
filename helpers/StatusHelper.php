<?php

class StatusHelper {
    public static function getStatusClass($status) {
        switch ($status) {
            case 'Menunggu tanggapan':
                return 'text-gray-600 bg-gray-300';
            case 'Diverifikasi':
                return 'text-cyan-600 bg-cyan-100';
            case 'Dalam tindakan':
                return 'text-yellow-600 bg-yellow-100';
            case 'Tuntas':
                return 'text-green-600 bg-green-100';
            case 'Ditolak':
                return 'text-red-600 bg-red-100';
            default:
                return 'text-gray-600 bg-gray-100';  // Default case if status doesn't match
        }
    }

    public static function getJenisLaporanClass($jenisLaporan) {
        switch ($jenisLaporan) {
            case 'anonim':
                return 'text-gray-600 bg-gray-100';  // Styling for 'Anonim'
            case 'terbuka':
                return 'text-blue-600 bg-blue-100';  // Styling for 'Terbuka'
            case 'rahasia':
                return 'text-purple-600 bg-purple-100';  // Styling for 'Rahasia'
            default:
                return 'text-gray-600 bg-gray-100';  // Default case if jenis_laporan doesn't match
        }
    }
}
?>
