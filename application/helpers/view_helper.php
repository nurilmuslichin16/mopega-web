<?php

function tipe($data)
{
    switch ($data) {
        case 'Indihome':
            return "<span class='badge badge-warning'>Indihome</span>";
            break;

        case 'BGES / VPN IP':
            return "<span class='badge badge-success'>BGES / VPN IP</span>";
            break;

        default:
            return "<span class='badge badge-info'>WIFI ID</span>";
            break;
    }
}

function status($data)
{
    switch ($data) {
        case '1':
            return "<span class='badge badge-danger'>Wait Order & Ordered</span>";
            break;

        case '2':
            return "<span class='badge badge-primary'>On The Way</span>";
            break;

        case '3':
            return "<span class='badge badge-warning'>On Going Progress</span>";
            break;

        default:
            return "<span class='badge badge-success'>Closed</span>";
            break;
    }
}

function statusTeknisi($data)
{
    switch ($data) {
        case '1':
            return "<span class='badge badge-success'>Aktif</span>";
            break;

        default:
            return "<span class='badge badge-danger'>Blocked</span>";
            break;
    }
}

function logAction($data)
{
    switch ($data) {
        case '0':
            return "<span class='badge badge-danger'>Wait Order</span>";
            break;

        case '1':
            return "<span class='badge badge-info'>Ordered</span>";
            break;

        case '2':
            return "<span class='badge badge-primary'>On The Way</span>";
            break;

        case '3':
            return "<span class='badge badge-warning'>On Going Progress</span>";
            break;

        default:
            return "<span class='badge badge-success'>Closed</span>";
            break;
    }
}

function date_indo($tgl)
{
    $ubah = gmdate($tgl, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tanggal = $pecah[2];
    $bulan = bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function bulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
