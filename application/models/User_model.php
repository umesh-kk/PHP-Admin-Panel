<?php

class User_model extends CI_Model {

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


    public function getUserLists($start=0,$limit,$key ) {
        $this->db->select('A.user_id ,A.first_name,A.last_name,A.email,B.country,B.dob,B.city,B.address,B.zipcode,A.active');
        $this->db->from('user_master A');
        $this->db->join('user_profile B', 'B.user_id = A.user_id','left');
        if($key != ''){
            $this->db->where("(A.email LIKE '%" . htmlspecialchars($key, ENT_QUOTES) . "%' OR A.first_name like '%" .  htmlspecialchars($key, ENT_QUOTES) . "%' OR A.last_name like '%" .  htmlspecialchars($key, ENT_QUOTES) . "%' OR concat(A.first_name,' ',A.last_name) like '%" .  htmlspecialchars($key, ENT_QUOTES) . "%')");   
        }
        $this->db->where('A.user_type', 3);
        $this->db->order_by('A.user_id', 'DESC');
        $this->db->limit($limit,$start);
        $query = $this->db->get();

        $res = $query->result_array();

        //echo $this->db->last_query();exit;
        return $res;
    }

    public function getUserListsCount($key) {
        //$this->db->like('title', 'match');
        if($key != ''){
            // $this->db->or_like('A.email',$key,'both');
            // $this->db->or_like('A.first_name',$key,'both');
            // $this->db->or_like('A.last_name',$key,'both');
            $this->db->where("(A.email LIKE '%" . htmlspecialchars($key, ENT_QUOTES) . "%' OR A.first_name like '%" .  htmlspecialchars($key, ENT_QUOTES) . "%' OR A.last_name like '%" .  htmlspecialchars($key, ENT_QUOTES) . "%' OR concat(A.first_name,' ',A.last_name) like '%" .  htmlspecialchars($key, ENT_QUOTES) . "%')");  
        }
        $this->db->where('A.user_type', 3);
        $this->db->from('user_master A');
        return $this->db->count_all_results(); 
    }
    public function getDetailsByID($user_id) {
        $this->db->select('A.user_id ,A.first_name,A.last_name,A.email,B.country,B.dob,B.city,B.address,B.zipcode,A.active,B.gender');
        $this->db->from('user_master A');
        $this->db->join('user_profile B', 'B.user_id = A.user_id','left');
        $this->db->where('A.user_id', $user_id );

        
        $query = $this->db->get();
        $res = $query->row_array();
        return $res;
    }
    
    public function getAgentDetailsByID($agent_id) {
        $this->db->select('A.*');
        $this->db->from('agent_master A');
        $this->db->where('A.agent_id', $agent_id );

        
        $query = $this->db->get();
        $res = $query->row_array();
        return $res;
    }
    
    

    public function getAgentLists($start=0,$limit,$key){
        $this->db->select('A.*');
        $this->db->from('agent_master A');
        if($key != ''){
			$this->db->or_like('A.email',$key,'both');
            $this->db->or_like('A.name',$key,'both');
        }
        $this->db->order_by('A.agent_id', 'DESC');
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        $res = $query->result_array();
        // echo $this->db->last_query();exit;
        return $res;
    }
    public function getAgentListsCount($key) {
        //$this->db->like('title', 'match');
        if($key != ''){
            $this->db->or_like('A.email',$key,'both');
            $this->db->or_like('A.name',$key,'both');
        }
        $this->db->from('agent_master A');
        return $this->db->count_all_results(); 
    }
    public function getCounts(){
        $sql = "SELECT 
		(SELECT count(*) FROM agent_master ) AS agentcount,
        (SELECT count(*) FROM user_master where user_type = 3) AS usercount,
        (SELECT count(*) FROM lesson_master ) AS lessoncount,
        (SELECT count(*) FROM video_master ) AS videocount,
        (SELECT count(*) FROM audio_master ) AS musiccount,
        (SELECT count(*) FROM question_master ) AS questioncount
        ";
		$query = $this->db->query($sql);
        $res    =    $query->row_array();
        return $res;
    }
    
    


    public function getLessonLists($start=0,$limit,$key){
        $this->db->select('A.*');
        $this->db->from('lesson_master A');
        if($key != ''){
			$this->db->or_like('A.title',$key,'both');
        }
        $this->db->order_by('A.lesson_id', 'DESC');
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }
    public function getLessonListsCount($key) {
        if($key != ''){
            $this->db->or_like('A.title',$key,'both');
        }
        $this->db->from('lesson_master A');
        return $this->db->count_all_results(); 
    }

    
    public function getLessonDetailsByID($lesson_id) {
        $this->db->select('A.*');
        $this->db->from('lesson_master A');
        $this->db->where('A.lesson_id', $lesson_id );
        $query = $this->db->get();
        $res = $query->row_array();
        return $res;
    }


    public function getVideosLists($start=0,$limit,$key){
       
        $this->db->select('A.*');
        $this->db->from('video_master A');
        if($key != ''){
			$this->db->or_like('A.title',$key,'both');
        }
        $this->db->order_by('A.id', 'DESC');
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }
    public function getVideosListsCount($key) {
        if($key != ''){
            $this->db->or_like('A.title',$key,'both');
        }
        $this->db->from('video_master A');
        return $this->db->count_all_results(); 
    }
    public function getVideosDetailsByID($id) {
        $this->db->select('A.*');
        $this->db->from('video_master A');
        $this->db->where('A.id', $id );
        $query = $this->db->get();
        $res = $query->row_array();
        return $res;
    }


    public function getMusicsLists($start=0,$limit,$key){
       
        $this->db->select('A.*');
        $this->db->from('audio_master A');
        if($key != ''){
			$this->db->or_like('A.title',$key,'both');
        }
        $this->db->order_by('A.id', 'DESC');
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }
    public function getMusicsListsCount($key) {
        if($key != ''){
            $this->db->or_like('A.title',$key,'both');
        }
        $this->db->from('audio_master A');
        return $this->db->count_all_results(); 
    }
    public function getMusicsDetailsByID($id) {
        $this->db->select('A.*');
        $this->db->from('audio_master A');
        $this->db->where('A.id', $id );
        $query = $this->db->get();
        $res = $query->row_array();
        return $res;
    }

    public function getQuestions($lesson_id='') {
        $this->db->select('A.*,B.*');
        $this->db->from('question_master A');
        $this->db->join('lesson_master B', 'B.lesson_id = A.lesson_id','left');
        if($lesson_id != ''){
            $this->db->where('A.lesson_id', $lesson_id );
        }

        
        $query = $this->db->get();
        $res = $query->result_array();
        return $res;
    }

    public function get_log ($user_id) {
        $sql = "SELECT user_log_master.*,CONCAT (user_master.first_name,' ',user_master.last_name) as name,
                SUM(TIME_TO_SEC(TIMEDIFF(user_log_master.end_time,user_log_master.start_time))) as total_time
                FROM user_log_master
                INNER JOIN user_master
                ON user_log_master.user_id = user_master.user_id
                WHERE user_log_master.user_id = $user_id";
		$query = $this->db->query($sql);
        $res    =    $query->row_array();
        return $res;
    }
    
    public function get_log_details ($user_id) {
        $sql = "SELECT A.log_id,A.user_id,
                DATE_FORMAT(A.start_time,'%M %D, %Y %H:%i:%s') as start_time,
                DATE_FORMAT(A.end_time,'%M %D, %Y %H:%i:%s') as end_time,
                CONCAT (user_master.first_name,' ',user_master.last_name) as name
                        FROM user_log_master A
                        INNER JOIN user_master
                        ON A.user_id = user_master.user_id
                        WHERE A.end_time != '' AND A.end_time > A.start_time AND A.user_id =  $user_id";
		$query = $this->db->query($sql);
        $res    =    $query->result_array();
        return $res;
    }

}
