<?php

class StatusButtonHelper
{
    public static function getStatusButton($status)
    {
        $btn = 'white';

        switch ($status) {
            case 'Menunggu tanggapan':
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