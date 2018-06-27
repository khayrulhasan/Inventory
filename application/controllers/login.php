<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index() {
        $this->user_session = $this->session->userdata('logged_in');
        if ($this->user_session) {
            redirect('index.php/lookUp');
        }else{
        $this->load->view('login/index');
        }
    }

    public function checkUser() {
        $u_name = $this->input->post('user_name');
        $u_password = $this->input->post('user_password');
        $result = $this->admin_model->checkUserInfo($u_name, md5($u_password));

        if ($result) {
            $sessionData = array(
                'user_id' => $result->id,
                'user_name' => $result->name,
                'user_status' => $result->status,
            );
            $this->session->set_userdata('logged_in', $sessionData);
            redirect('index.php/lookUp/index');
        } else {
            $sdata['message'] = "Whoops! We didn't recognise your username or password. Please try again.";
            $this->session->set_userdata($sdata);
            redirect('index.php/login/index');
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('index.php/login/index');
    }

}

