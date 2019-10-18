<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logexpense_model
 *
 * @Prasan Srisopa
 */
class Logexpense_model extends CI_Model{
    //put your code here
    public function log_expense() {
        $this->db->join('expense', 'log_expense.expense_id = expense.expense_id');
        $this->db->where('log_expense.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('log_expense.date_modify','DESC');
        return $this->db->get('log_expense');
    }
}
