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