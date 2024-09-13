<?php

class ActionButtonHelper
{
    public static function getActionButtons($laporan, $userLevel)
    {
        $buttons = '<div class="text-end"><div class="d-grid gap-2 d-md-flex justify-content-md-end">';

        // Admin buttons
        if ($userLevel == 'Admin') {
            // Show "Edit Status" button only if the status is not "Tuntas"
            if ($laporan['status'] != "Tuntas") {
                $buttons .= '<button class="btn btn-warning w-100 w-md-auto me-2" data-bs-toggle="modal" data-bs-target="#statusModal">';
                $buttons .= '<i class="bi bi-pencil-square me-1"></i>Edit Status</button>';
            }

            // Conditional buttons based on the report status
            if ($laporan['status'] == "Dalam tindakan") {
                $buttons .= '<button class="btn btn-success w-100 w-md-auto me-2" data-bs-toggle="modal" data-bs-target="#responseModal">';
                $buttons .= '<i class="bi bi-reply-fill me-1"></i>Tuntas</button>';
            } elseif ($laporan['status'] == "Ditolak") {
                $buttons .= '<button class="btn btn-success w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#restoreModal">';
                $buttons .= '<i class="bi bi-arrow-counterclockwise me-1"></i>Kembalikan Laporan</button>';
            } elseif ($laporan['status'] == "Tuntas") {
                $buttons .= '<button class="btn btn-success w-100 w-md-auto me-2" data-bs-toggle="modal" data-bs-target="#completeModal">';
                $buttons .= '<i class="bi bi-check-circle me-1"></i>Laporan Tuntas</button>';
            } elseif ($laporan['status'] == "Menunggu tanggapan") {
                $buttons .= '<button class="btn btn-danger w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#rejectModal">';
                $buttons .= '<i class="bi bi-x-circle-fill me-1"></i>Tolak Laporan</button>';
            } elseif ($laporan['status'] == "Diverifikasi") {
                $buttons .= '<button class="btn btn-primary w-100 w-md-auto me-2" data-bs-toggle="modal" data-bs-target="#actionModal">';
                $buttons .= '<i class="bi bi-play-circle me-1"></i>Dalam Tindakan</button>';
            }
        }

        // Petugas buttons
        if ($userLevel === 'Petugas') {
            if ($laporan['status'] == "Menunggu tanggapan") {
                $buttons .= '<button class="btn btn-info w-100 w-md-auto me-2" data-bs-toggle="modal" data-bs-target="#verifyModal">';
                $buttons .= '<i class="bi bi-check-circle me-1"></i>Verifikasi</button>';

                // Petugas tidak dapat menolak laporan
                // Menghapus tombol "Tolak" untuk Petugas
            } elseif ($laporan['status'] == "Dalam tindakan") {
                $buttons .= '<button class="btn btn-success w-100 w-md-auto me-2" data-bs-toggle="modal" data-bs-target="#responseModal">';
                $buttons .= '<i class="bi bi-reply-fill me-1"></i>Tuntas</button>';
            } elseif ($laporan['status'] == "Tuntas") {
                $buttons .= '<button class="btn btn-success w-100 w-md-auto me-2" data-bs-toggle="modal" data-bs-target="#completeModal">';
                $buttons .= '<i class="bi bi-check-circle me-1"></i>Laporan Tuntas</button>';
            } elseif ($laporan['status'] == "Diverifikasi") {
                $buttons .= '<button class="btn btn-warning w-100 w-md-auto me-2" data-bs-toggle="modal" data-bs-target="#actionModal">';
                $buttons .= '<i class="bi bi-play-circle me-1"></i>Dalam Tindakan</button>';
            }
        }

        $buttons .= '</div></div>';

        return $buttons;
    }
}
