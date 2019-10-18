<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Groupmenu
 *
 * @Prasan Srisopa
 */
class Groupmenu extends CI_Controller {

    //put your code here
    public $menu_id = 5;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin($this->menu_id);
        $this->load->model('admin/groupmenu_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-gears',
            'title' => 'กลุ่มเมนู',
            'datas' => $this->groupmenu_model->get_groupmenu(),
        );
        $this->renderViewAdmin('groupmenu_view', $data);
    }

    public function menu($id = null) {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-gear',
            'title' => 'จัดการเมนู',
            'css' => array(),
            'plugins_js' => array(),
            'datas' => $this->groupmenu_model->get_menu_group_menu($id),
            'group_menu_id' => $id
        );
        $this->renderViewAdmin('menu_view', $data);
    }

    public function addgroupmenu() {
        $data = array(
            'group_menu_name' => $this->input->post('group_menu_name'),
            'group_menu_icon' => $this->input->post('group_menu_icon'),
            'group_menu_public' => 1,
            'group_menu_sort' => $this->groupmenu_model->get_last_groupMenu()->row()->group_menu_sort + 1,
            'date_modify' => $this->mics->getdate()
        );
        $this->groupmenu_model->addgroupmenu($data);
        redirect(base_url('admin/groupmenu'));
    }
    
    public function groupmenuedit() {
        $id = $this->input->post('group_menu_id');
        $data = array(
            'data' => $this->groupmenu_model->get_groupmenu($id)->row(),
        );
        $this->load->view('admin/modal/edit_groupmenu_modal', $data);
    }
    
    public function editgroupmenu() {
        $data = array(
            'group_menu_name' => $this->input->post('group_menu_name'),
            'group_menu_icon' => $this->input->post('group_menu_icon'),
            'group_menu_public' => 1,
            'date_modify' => $this->mics->getdate()
        );
        $this->groupmenu_model->editgroupmenu($this->input->post('group_menu_id'),$data);
        redirect(base_url('admin/groupmenu'));
    }
    
    public function deletegroupmenu($id) {
        $this->groupmenu_model->deletegroupmenu($id);
        redirect(base_url('admin/groupmenu'));
    }
    
    public function addmenu() {
        $group_menu_id = $this->input->post('group_menu_id');
        $data = array(
            'group_menu_id' => $group_menu_id,
            'menu_name' => $this->input->post('menu_name'),
            'menu_link' => $this->input->post('menu_link'),
            'menu_status_id' => 1,
            'menu_sort' => $this->groupmenu_model->get_last_menu($group_menu_id)->row()->menu_sort + 1,
            'menu_modify' => $this->mics->getdate()
        );
        $this->groupmenu_model->addmenu($data);
        redirect(base_url('admin/groupmenu/menu/'.$group_menu_id));
    }
    
    public function menuedit() {
        $id = $this->input->post('menu_id');
        $data = array(
            'data' => $this->groupmenu_model->get_menu($id)->row(),
        );
        $this->load->view('admin/modal/edit_menu_modal', $data);
    }
    
    public function editmenu() {
        $group_menu_id = $this->input->post('group_menu_id');
        $data = array(
            'menu_name' => $this->input->post('menu_name'),
            'menu_link' => $this->input->post('menu_link'),
            'menu_status_id' => $this->input->post('menu_status_id'),
            'menu_modify' => $this->mics->getdate()
        );
        $this->groupmenu_model->editmenu($this->input->post('menu_id'),$data);
        redirect(base_url('admin/groupmenu/menu/'.$group_menu_id));
    }
    
    public function deletemenu($group_menu_id,$id) {
        $this->groupmenu_model->deletemenu($id);
        redirect(base_url('admin/groupmenu/menu/'.$group_menu_id));
    }
    
    //sort
    public function sortgroupmenu() {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-gears',
            'title' => 'จัดเรียงกลุ่มเมนู',
            'js' => array('jquery-ui.min.js', 'sortable.js', 'build/sort.js')
        );
        $this->renderViewAdmin('groupmenu_sort_view', $data);
    }

    public function sortgroupmenumap() {
        $array = $this->input->post('array');
        $count = 1;
        foreach ($array as $id) {
            $data = array(
                'group_menu_sort' => $count,
            );
            $this->groupmenu_model->updategroupmenusort($data, $id);
            $count++;
        }
    }

    public function sortmenu($group_menu_id) {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-gear',
            'title' => 'จัดเรียงเมนู',
            'group_menu_id' => $group_menu_id,
            'js' => array('jquery-ui.min.js', 'sortable.js', 'build/sort.js'),
        );
        $this->renderViewAdmin('menu_sort_view', $data);
    }

    public function sortmenumap() {
        $array = $this->input->post('array');
        $count = 1;
        foreach ($array as $id) {
            $data = array(
                'menu_sort' => $count,
            );
            $this->groupmenu_model->updatemenusort($data, $id);
            $count++;
        }
    }



}
