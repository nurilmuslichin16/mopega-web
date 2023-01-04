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
}
