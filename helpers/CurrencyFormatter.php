<?php
class CurrencyFormatter {
    // Kurs konversi dan lambang mata uang berdasarkan acuan Rupiah
    private static $exchangeRates = [
        'USD' => ['rate' => 15000, 'symbol' => '$'],  // Dollar Amerika
        'EUR' => ['rate' => 16000, 'symbol' => '€'],  // Euro
        'JPY' => ['rate' => 110, 'symbol' => '¥'],    // Yen Jepang
        'IDR' => ['rate' => 1, 'symbol' => 'Rp']      // Rupiah
    ];

    public static function formatCurrency(float $amount, string $currency = 'IDR'): string {
        // Cek apakah mata uang tersedia dalam daftar
        if (array_key_exists($currency, self::$exchangeRates)) {
            // Ambil kurs dan simbol mata uang
            $rate = self::$exchangeRates[$currency]['rate'];
            $symbol = self::$exchangeRates[$currency]['symbol'];

            // Konversi jumlah ke Rupiah
            $amountInRupiah = $amount * $rate;

            // Format dan kembalikan hasilnya
            return $symbol . ' ' . number_format($amountInRupiah, 0, ',', '.');
        } else {
            return 'Mata uang tidak dikenal';
        }
    }
}

// // Contoh penggunaan
// echo CurrencyFormatter::formatCurrency(100, 'USD'); // Output: $ 1.500.000
// echo CurrencyFormatter::formatCurrency(100, 'EUR'); // Output: € 1.600.000
// echo CurrencyFormatter::formatCurrency(100, 'JPY'); // Output: ¥ 11.000
// echo CurrencyFormatter::formatCurrency(100, 'IDR'); // Output: Rp 100
