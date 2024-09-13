<?php
class ModalHelper
{
    public static function loadTemplate($template, $data = [])
    {
        // Ekstrak array data menjadi variabel individual
        extract($data);

        // Mulai output buffering
        ob_start();

        // Sertakan template yang diinginkan dengan path yang benar
        include __DIR__ . "/../views/backend/templates/modals/{$template}.php";

        // Dapatkan isi buffer dan bersihkan buffer
        return ob_get_clean();
    }

    public static function statusModal($laporan)
    {
        return self::loadTemplate('status_modal', ['laporan' => $laporan]);
    }

    public static function responseModal($laporan)
    {
        return self::loadTemplate('response_modal', ['laporan' => $laporan]);
    }

    public static function rejectModal($laporan)
    {
        return self::loadTemplate('reject_modal', ['laporan' => $laporan]);
    }

    public static function restoreModal($laporan)
    {
        return self::loadTemplate('restore_modal', ['laporan' => $laporan]);
    }

    public static function verifyModal($laporan)
    {
        return self::loadTemplate('verify_modal', ['laporan' => $laporan]);
    }
    public static function actionModal($laporan)
    {
        return self::loadTemplate('action_modal', ['laporan' => $laporan]);
    }
}
