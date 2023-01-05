<?php

class Model_log extends CI_Model
{
    public $table = 'tb_log';

    public function insert($data)
    {
        // Jalankan query
        $query = $this->db->insert($this->table, $data);

        // Return hasil query
        return $query;
    }
}
