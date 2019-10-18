<?php

class Role_model extends CI_Model {
    //put your code here
    public function get_role($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('role_id', $id);
        }
        return $this->db->get('role');
    }
    
    public function get_menu($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('menu_id', $id);
        }
        $this->db->join('group_menu','group_menu.group_menu_id = menu.group_menu_id');
        return $this->db->get('menu');
    }
    
    public function check_StetusRole($role_id, $menu_id) {
        $this->db->where('map_menu_role.role_id', $role_id);
        $this->db->where('map_menu_role.menu_id', $menu_id);
        return $this->db->count_all_results('map_menu_role');
    }
    
    public function addrole($data) {
        $this->db->insert('map_menu_role', $data);
        return 1;
    }

    public function deleterole($role_id,$menu_id) {
        $this->db->where('role_id', $role_id);
        $this->db->where('menu_id', $menu_id);
        $this->db->delete('map_menu_role');
        return 1;
    }

}
