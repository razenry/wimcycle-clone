<?php

class ExtendsHelper {
    public static function getMotivation() {
        // Array berisi kata-kata motivasi tentang programming
        $motivations = array(
            "Kode adalah seni, dan setiap programmer adalah senimannya.",
            "Dalam dunia pemrograman, kegagalan adalah batu loncatan menuju keberhasilan.",
            "Jangan hanya menulis kode; ciptakan solusi yang elegan dan efektif.",
            "Semangat belajar adalah kunci untuk menjadi programmer yang hebat.",
            "Pemrograman adalah tentang menciptakan sesuatu dari ketiadaan.",
            "Setiap baris kode adalah langkah menuju pemahaman yang lebih baik.",
            "Jangan pernah puas dengan solusi pertama; selalu cari cara yang lebih baik.",
            "Kompleksitas dalam kode adalah tanda dari tantangan yang harus dipecahkan.",
            "Setiap masalah adalah peluang untuk berpikir kreatif.",
            "Programmer terbaik adalah mereka yang terus menerus mencari cara untuk meningkatkan diri.",
            "Pemrograman adalah perjalanan, bukan tujuan akhir.",
            "Jangan takut untuk mengubah kode kamu; perubahan sering kali membawa perbaikan.",
            "Keberhasilan dalam pemrograman datang dari ketekunan dan kerja keras.",
            "Kemampuan untuk memecahkan masalah adalah keterampilan utama dalam pemrograman.",
            "Setiap kesalahan adalah kesempatan untuk belajar sesuatu yang baru.",
            "Pemrograman adalah tentang menemukan solusi yang tidak terlihat pada awalnya.",
            "Jangan biarkan bug menghentikanmu; setiap bug adalah peluang untuk berkembang.",
            "Tulis kode seolah-olah orang lain akan membacanya, dan kamu akan menjadi programmer yang lebih baik.",
            "Hasil kerja keras dalam pemrograman akan selalu terbayar pada akhirnya.",
            "Cobalah untuk memahami masalah secara mendalam sebelum menulis kode.",
            "Pemrograman adalah seni menyederhanakan kompleksitas.",
            "Tidak ada batasan dalam pemrograman selain imajinasi kita sendiri.",
            "Teruslah belajar dan beradaptasi; dunia pemrograman tidak pernah berhenti berkembang.",
            "Pikiran kreatif adalah alat terbaik dalam pemrograman.",
            "Kemajuan dalam pemrograman sering kali memerlukan pemikiran di luar batas.",
            "Ketika kamu menemukan solusi yang elegan, kamu akan merasakan kepuasan yang mendalam.",
            "Setiap tantangan dalam pemrograman adalah kesempatan untuk meningkatkan keterampilanmu.",
            "Pemrograman bukan hanya tentang menulis kode, tetapi tentang menyelesaikan masalah dengan cara yang inovatif.",
            "Hasil terbaik dalam pemrograman sering kali datang dari eksperimen dan eksplorasi.",
            "Jangan takut untuk menguji batasan-batasanmu; di situlah kamu akan menemukan potensi sebenarnya.",
            "Pemrograman adalah seni menyederhanakan masalah yang kompleks menjadi solusi yang elegan.",
            "Menjadi programmer yang hebat berarti terus-menerus memperbaiki dan menyempurnakan keterampilanmu.",
            "Jangan hanya menulis kode; ciptakan sesuatu yang bermanfaat dan berarti.",
            "Tiap proyek pemrograman adalah kesempatan untuk belajar dan tumbuh.",
            "Dalam pemrograman, kesalahan adalah guru yang terbaik.",
            "Pemrograman adalah proses terus-menerus mencari solusi terbaik untuk masalah yang ada.",
            "Jangan pernah berhenti mencari cara untuk meningkatkan kualitas kodenmu.",
            "Kreativitas dan inovasi adalah inti dari pemrograman yang sukses.",
            "Keberhasilan dalam pemrograman datang dari ketahanan dan kemauan untuk terus belajar."
        );        

        // Pilih kata motivasi secara acak
        return $motivations[array_rand($motivations)];
        
    }
}
