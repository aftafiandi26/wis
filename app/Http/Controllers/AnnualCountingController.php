<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;

class AnnualCountingController extends Controller
{
    public function month($start, $end)
    {
        // Tanggal awal
        $startDate = new DateTime($start);

        // Tanggal akhir
        $endDate = new DateTime($end);

        // Menghitung selisih
        $interval = $startDate->diff($endDate);

        $increment = 0;

        if ($interval->d >= 28) {
            $increment = 1;
        }

        // Mendapatkan jumlah bulan
        $months = ($interval->y * 12) + $interval->m + $increment;

        return $months;
    }

    public function monthComming($start)
    {
        // Tanggal awal
        $startDate = new DateTime($start);

        // Tanggal akhir
        $endDate = new DateTime();

        // Menghitung selisih
        $interval = $startDate->diff($endDate);

        $increment = 0;

        if ($interval->d >= 28) {
            $increment = 1;
        }

        // Mendapatkan jumlah bulan
        $months = ($interval->y * 12) + $interval->m + $increment;

        return $months;
    }
}
