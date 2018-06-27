<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    function checkUserInfo($u, $p) {
        $user = array('name' => $u, 'password' => $p, 'active_status'=>1);
        $this->db->where($user);
        $query_result = $this->db->get('tbl_user');
        return $query_result->row();
        
    }

}

