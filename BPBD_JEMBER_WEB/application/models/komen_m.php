<?php defined('BASEPATH') OR exit('No direct script access allowed');

class komen_m extends CI_Model
{
    public function getKomenAll($id_brt)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_komentar', 'tb_user.ID_USR = tb_komentar.ID_USR');
        $this->db->order_by('TIMESTAMP', 'ASC');
        return $this->db->get_where('', ['ID_BRT' => $id_brt])->result_array();
    }

    public function setKomen($data)
    {
        $this->db->insert('tb_komentar', $data);
    }


}