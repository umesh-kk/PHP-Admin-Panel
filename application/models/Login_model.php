<?php

class Login_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        //date_default_timezone_set('GMT');
    }

    public function insert($table, $data) {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update($table, $data, $cond) {
        return $this->db->update($table, $data, $cond);
    }

    public function delete_records($table, $data) {
        return $this->db->delete($table, $data);
    }

    public function get_where($table, $data, $order_by = "id ASC", $type = "row") {
        
        $query = $this->db->order_by($order_by)->get_where($table, $data);
        if ($type == "row") {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }


    public function login($email) {
        $this->db->select('A.*');
        $this->db->from('user_master A');
        $this->db->where('A.email', $email);
        $this->db->where('A.user_type', 1);
        $query = $this->db->get();
        $res = $query->row_array();

        return $res;
    }
    public function agentlogin($email) {
        $this->db->select('A.*');
        $this->db->from('agent_master A');
        $this->db->where('A.email', $email);
        $query = $this->db->get();
        $res = $query->row_array();

        return $res;
    }

    

}
