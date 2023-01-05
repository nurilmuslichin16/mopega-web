<?php

class Model_gangguan extends CI_Model
{
    public $table = 'tb_gangguan';

    public function get_all()
    {
        // Jalankan query
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_gangguan.id_pelanggan');
        $query = $this->db->get();

        // Return hasil query
        return $query;
    }

    public function get_where($where)
    {
        // Jalankan query
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_gangguan.id_pelanggan');
        $this->db->join('tb_teknisi', 'tb_teknisi.id_telegram = tb_gangguan.teknisi');
        $this->db->where($where);
        $query = $this->db->get();

        // Return hasil query
        return $query;
    }

    public function insert($data)
    {
        // Jalankan query
        $query = $this->db->insert($this->table, $data);

        // Return hasil query
        return $query;
    }

    public function update($id, $data)
    {
        // Jalankan query
        $query = $this->db
            ->where('id_gangguan', $id)
            ->update($this->table, $data);

        // Return hasil query
        return $query;
    }

    public function delete($id)
    {
        // Jalankan query
        $query = $this->db
            ->where('id_gangguan', $id)
            ->delete($this->table);

        // Return hasil query
        return $query;
    }

    public function log($tiket)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_log', 'tb_log.id_gangguan = tb_gangguan.id_gangguan');
        $this->db->where('tiket', $tiket);
        $this->db->order_by('waktu');
        $query = $this->db->get();

        return $query;
    }

    public function cetak($tgl_awal, $tgl_akhir, $tipe, $status)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_gangguan.id_pelanggan');
        $this->db->join('tb_teknisi', 'tb_teknisi.id_telegram = tb_gangguan.teknisi');

        if ($tgl_awal != null && $tgl_awal != '') {
            if ($tgl_akhir != null && $tgl_akhir != '') {
                $this->db->where('date(report_date) >=', $tgl_awal);
                $this->db->where('date(report_date) <=', $tgl_akhir);
            } else {
                $this->db->where('date(report_date)', $tgl_awal);
            }
        }

        if ($tipe != null && $tipe != '') {
            $this->db->where('tipe', $tipe);
        }

        if ($status != null && $status != '') {
            $this->db->where('status', $status);
        }

        $query = $this->db->get();

        return $query;
    }

    public function dashboard()
    {
        $this->db->select("
            /*TOTAL GANGGUAN*/
            SUM(CASE WHEN (month(date(report_date)) = MONTH(CURRENT_DATE())) THEN 1 ELSE 0 END) as bulanan,
            SUM(CASE WHEN (date(report_date) = CURDATE()) THEN 1 ELSE 0 END) as harian,

            /*STATUS GANGGUAN*/
            SUM(CASE WHEN (status = '0' OR status = '1') THEN 1 ELSE 0 END) as wo_order,
            SUM(CASE WHEN (status = '2') THEN 1 ELSE 0 END) as otw,
            SUM(CASE WHEN (status = '3') THEN 1 ELSE 0 END) as ogp,
            SUM(CASE WHEN (status = '4') THEN 1 ELSE 0 END) as closed
        ");

        $this->db->from($this->table);
        $query = $this->db->get();

        return $query;
    }

    public function duplikatTiket($where)
    {
        // Jalankan query
        $this->db->select('tiket');
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();

        // Return hasil query
        return $query;
    }
}
