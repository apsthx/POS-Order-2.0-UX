<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bank_model
 *
 * @Prasan Srisopa
 */
class Bank_model extends CI_Model{
    //put your code here
     public function getBank($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('income_bank.income_bank_id', $id);
        }
        $this->db->order_by('income_bank.income_bank_id');
        return $this->db->get('income_bank');
    }
    
    public function add($data) {
        $this->db->insert('income_bank', $data);
    }   
    
    public function edit($id, $data) {
        $this->db->where('income_bank.income_bank_id', $id);
        $this->db->update('income_bank', $data);
    }
}
