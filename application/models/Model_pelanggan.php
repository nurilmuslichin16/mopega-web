<?php

class Model_pelanggan extends CI_Model
{
    public $table = 'tb_pelanggan';

    public function get_all()
    {
        // Jalankan query
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
            ->where('id_pelanggan', $id)
            ->update($this->table, $data);

        // Return hasil query
        return $query;
    }

    public function delete($id)
    {
        // Jalankan query
        $query = $this->db
            ->where('id_pelanggan', $id)
            ->delete($this->table);

        // Return hasil query
        return $query;
    }

    public function cekNomor($nomor)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('no_internet', $nomor);
        $this->db->or_where('no_voice', $nomor);
        $query = $this->db->get();

        return $query;
    }

    function upload_file($filename)
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('file')) {
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }
}
