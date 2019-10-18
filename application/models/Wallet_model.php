<?php

class Wallet_model extends CI_Model {

    //put your code here
    public function get_bank($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('bank_id', $id);
        }
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('bank');
    }

    public function add($data) {
        $this->db->insert('bank', $data);
    }

    public function edit($data) {
        $this->db->where('bank_id', $data['bank_id']);
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->update('bank', $data);
    }

    public function count_money_bank($id) {
        $this->db->where('bank_id', $id);
        $this->db->where('bank_money > ', 0);
        $this->db->limit(1);
        return $this->db->count_all_results('bank');
    }

    public function delete_bank($id) {
        $this->db->where('bank_id', $id);
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->delete('bank');
    }

}
