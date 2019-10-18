<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Groupmenu_model
 *
 * @Prasan Srisopa
 */
class Groupmenu_model extends CI_Model{
    //put your code here
    public function get_groupmenu($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('group_menu_id', $id);
        }
        $this->db->order_by('group_menu.group_menu_sort');
        return $this->db->get('group_menu');
    }
    
    public function get_menu_group_menu($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('group_menu_id', $id);
        }
        $this->db->order_by('menu.menu_sort');
        return $this->db->get('menu');
    }
    
    public function get_last_groupMenu() {
        $this->db->select('group_menu.group_menu_sort');
        $this->db->order_by('group_menu.group_menu_sort', 'desc');
        return $this->db->get('group_menu');
    }
    
    public function addgroupmenu($data) {
        $this->db->insert('group_menu', $data);
    }
    
    public function editgroupmenu($id, $data) {
        $this->db->where('group_menu.group_menu_id', $id);
        $this->db->update('group_menu', $data);
    }
    
    public function checkgroupmenu($group_menu_id) {
        $this->db->from('menu');
        $this->db->where('menu.group_menu_id', $group_menu_id);
        return $this->db->count_all_results();
    }
    
    public function deletegroupmenu($id) {
        $this->db->where('group_menu.group_menu_id', $id);
        $this->db->delete('group_menu');
    }    
    
    
    // menu
    
    public function get_menu($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('menu_id', $id);
        }
        $this->db->order_by('menu.menu_sort');
        return $this->db->get('menu');
    }
    
    public function get_last_menu($group_menu_id) {
        $this->db->select('menu.menu_sort');
        $this->db->where('menu.group_menu_id', $group_menu_id);
        $this->db->order_by('menu.menu_sort', 'desc');
        return $this->db->get('menu');
    }
    
    public function addmenu($data) {
        $this->db->insert('menu', $data);
    }
    
    public function editmenu($id, $data) {
        $this->db->where('menu.menu_id', $id);
        $this->db->update('menu', $data);
    }
    
    public function checkmenu($menu_id) {
        $this->db->from('map_menu_role');
        $this->db->where('map_menu_role.menu_id', $menu_id);
        return $this->db->count_all_results();
    }
    
    public function deletemenu($id) {
        $this->db->where('menu.menu_id', $id);
        $this->db->delete('menu');
    }
    
    //sort
    public function updategroupmenusort($data, $id) {
        $this->db->where('group_menu.group_menu_id', $id);
        $this->db->update('group_menu', $data);
    }

    public function updatemenusort($data, $id) {
        $this->db->where('menu.menu_id', $id);
        $this->db->update('menu', $data);
    }
    
}
