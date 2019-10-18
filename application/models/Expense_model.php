<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Shop_model
 *
 * @author Prasan Srisopa
 */
class Expense_model extends CI_Model {

    //put your code here
    public function get_data($id = null, $status_id = 1) {
        $this->db->select('*');
        $this->db->join('ref_status_expense', 'expense.status_expense_id = ref_status_expense.status_expense_id');
        $this->db->join('bank', 'expense.bank_id = bank.bank_id');
        $this->db->where('expense.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('expense.expense_id', $id);
        }
        if ($status_id == 1) {
            $this->db->where('expense.status_expense_id != ', 3);
        }
        $this->db->order_by('expense.expense_id', 'DESC');
        return $this->db->get('expense');
    }

    public function update_data($data) {
        $this->db->where('expense_id', $data['expense_id']);
        $this->db->update('expense', $data);
    }

    public function get_bank($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('bank_id', $id);
        }
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('bank');
    }

    public function bank_update($data) {
        $this->db->where('bank.bank_id', $data['bank_id']);
        $this->db->update('bank', $data);
    }

}
