<?php

function sendChat($telegram_id, $message_text)
{
    $url = "https://api.telegram.org/bot5711494409:AAF5I3Qlc62h7CZenfu_ib2v15QhIybPk40/sendMessage?chat_id=" . $telegram_id;
    $url = $url . "&text=" . urlencode($message_text);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}

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

function statusText($data)
{
    switch ($data) {
        case '0':
            return "Wait Order";
            break;

        case '1':
            return "Ordered";
            break;

        case '2':
            return "On The Way";
            break;

        case '3':
            return "On Going Progress";
            break;

        default:
            return "Closed";
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

function expired($booking_date)
{
    $now = date("Y-m-d H:i:s");
    if ($now > $booking_date) {
        return "<span class='badge badge-danger'>$booking_date</span>";
    } else {
        return "<span class='badge badge-warning'>$booking_date</span>";
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

function logActionText($data)
{
    switch ($data) {
        case '0':
            return "Laporan Dibuat";
            break;

        case '1':
            return "Tiket Dikirim Ke Teknisi";
            break;

        case '2':
            return "Teknisi Menuju Lokasi Pelanggan";
            break;

        case '3':
            return "Sedang Dikerjakan Teknisi";
            break;

        default:
            return "Jaringan Sudah Normal";
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

function date_indo_jam($waktu)
{
    $pecah  = explode(" ", $waktu);
    $tgl    = $pecah[0];
    $jam    = $pecah[1];

    $pecahtgl   = explode("-", $tgl);
    $tanggal    = $pecahtgl[2];
    $bulan      = bulan($pecahtgl[1]);
    $tahun      = $pecahtgl[0];

    $pecahjam   = explode(":", $jam);
    $detik      = $pecahjam[2];
    $menit      = $pecahjam[1];
    $pukul      = $pecahjam[0];

    return $tanggal . ' ' . $bulan . ' ' . $tahun . ' ' . $pukul . ':' . $menit . ':' . $detik;
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
