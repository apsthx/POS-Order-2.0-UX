<?php

class Uploadimage extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->model('uploadimage_model');
    }

    public function index() {
        $this->load->view('uploadimage_view');
    }

    public function upload() {
        $this->load->library('image_lib');

        $path = './assets/upload/img';
        $link_part = base_url() . 'store/image/';

        $config['upload_path'] = $path;
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = 8192;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
//            print_r($this->upload->data());
            $link_upload = $this->upload->data('file_name');
            $data = array(
                'image_name' => $link_upload,
                'date_modify' => $this->mics->getDate()
            );
            $this->db->insert('image', $data);
        } else {
//            print_r($this->upload->display_errors());
        }
        redirect(base_url() . 'uploadimage');
    }

}
