<?php

class Model_teknisi extends CI_Model
{
    public $table = 'tb_teknisi';

    public function get_all()
    {
        // Jalankan query
        $query = $this->db->get($this->table);

        // Return hasil query
        return $query;
    }

    public function get_all_active()
    {
        // Jalankan query
        $this->db->where('status', 1);
        $query = $this->db->get($this->table);

        // Return hasil query
        return $query;
    }

    public function get_where($where)
    {
        // Jalankan query
        $query = $this->db
            ->where($where)
            ->get($this->table);

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
            ->where('id_telegram', $id)
            ->update($this->table, $data);

        // Return hasil query
        return $query;
    }

    public function delete($id)
    {
        // Jalankan query
        $query = $this->db
            ->where('id_telegram', $id)
            ->delete($this->table);

        // Return hasil query
        return $query;
    }
}
