<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Prasan Srisopa
 */
class Shopsetting extends CI_Controller {

    public $group_id = 4;
    public $menu_id = 24;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('shopsetting_model');
    }

    public function index() {
        $data = array(
            'data' => $this->shopsetting_model->get_shop()->row(),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array(),
        );
        $this->renderView('shopsetting_view', $data);
    }

    public function upload_image() {
        $json = array();
        $this->load->library('image_lib');

        $path = "./assets/upload/img/"; //server path
        $config = array(
            'upload_path' => $path,
            'allowed_types' => 'jpg|png',
            'overwrite' => 1,
            'max_size' => 8192
        );

        $this->load->library('upload', $config);
        foreach ($_FILES as $key) {
            $name_type = explode('.', $key['name']);
            if (!(preg_match("/^[a-zA-Z0-9\_\-]+$/", $name_type[0]))) {
                $key['name'] = "abc." . $name_type[1];
            }
            $_FILES['image']['name'] = $key['name'];
            $_FILES['image']['type'] = $key['type'];
            $_FILES['image']['tmp_name'] = $key['tmp_name'];
            $_FILES['image']['size'] = $key['size'];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $data = array(
                    'image_name' => $this->upload->data('file_name'),
                    'date_modify' => $this->mics->getDate()
                );
                $this->db->insert('image', $data);
                $image_id = $this->db->insert_id();
                $data_shop = array(
                    'image_id' => $image_id,
                    'date_modify' => $this->mics->getDate()
                );
                $this->shopsetting_model->update_shop($data_shop);
                $json['file_name'] = $this->upload->data('file_name');
                $json['error'] = FALSE;
            } else {
                $json['file_name'] = '';
                $json['error'] = TRUE;
            }
        }
        echo json_encode($json);
    }

    public function edit() {
        $data = array(
            'shop_name' => $this->input->post('shop_name'),
            'tax_id' => $this->input->post('tax_id'),
            'tel_shop' => $this->input->post('tel_shop'),
            'fax_shop' => $this->input->post('fax_shop'),
            'website_shop' => $this->input->post('website_shop'),
            'email_shop' => $this->input->post('email_shop'),
            'address_shop' => $this->input->post('address_shop'),
            'shop_promptpay_id' => $this->input->post('shop_promptpay_id'),
            'shop_promptpay_name' => $this->input->post('shop_promptpay_name'),
            'date_modify' => $this->mics->getDate()
        );
        $this->shopsetting_model->update_shop($data);
        redirect('shopsetting');
    }

}
