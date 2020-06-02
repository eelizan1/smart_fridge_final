<?php 
class User_model extends CI_Model{
	public function register(){
		 $data = array(
            'first_name' => $this->input->post('first_name'),
			'last_name'  => $this->input->post('last_name'),
            'email'      => $this->input->post('email'),
            'username'   => $this->input->post('username'),
            'password'   => md5($this->input->post('password'))
        );
		$insert = $this->db->insert('users', $data);
		return $insert;
	}
	
	public function login($username,$password){  
        //Validate
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        
        $result = $this->db->get('users');
        if($result->num_rows() == 1){
            return $result->row(0)->id;
        } else {
            return false;
        }
    }
    
    public function get_db_customer_info($user_id) {
        
        $this->db->select('*'); 
        $this->db->from('users'); 
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        
        // returns the result row
        // it is 'row()' since its a single product 
        return $query->row(); 
    }
    
    
    
    
}