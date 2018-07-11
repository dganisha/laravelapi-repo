<?php
namespace App\Helpers;

// class Rupiah {
//     public static function getRupiah($value) {
//         $format = "Rp. " . number_format($value,2,',','.');
//         return $format;
//     }
// }

class Helpers {
    public static function getRupiah($value) {
        $format = "Rp. " . number_format($value,2,',','.');
        return $format;
    }

    public static function contohHelper() {
    	return "Nyantai boss";
    }
}

// function tesHelper() {
// 	return "Coba helper baru";
// }