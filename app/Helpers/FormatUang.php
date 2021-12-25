<?php

namespace App\Helpers;

function FormatUang($angka)
{
    $hasil =  number_format($angka, 0, ',', '.');
    return $hasil;
}
