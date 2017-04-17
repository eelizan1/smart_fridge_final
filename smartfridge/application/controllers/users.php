<?php

    ob_start(); // to remove header error

class Users extends CI_Controller{
    
    
    public function register(){
        
         // form validation rules (form name, humn readble, form rules (check CI documentation))
         $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]|max_length[20]');
         $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
         $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        
        
         $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[16]');
         $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[50]');
         $this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|matches[password]');
        
        if($this->form_validation->run() == FALSE) {
        // show view 
        $data['main_content'] = 'register'; //--> register view 
        $this->load->view('layouts/main', $data); 
        
        // load url helper in autoloader 
        
        // load form validation library in autoloader in library 
        
        } else {
            
        // tests if data was inserted into db     
          if($this->User_model->register()) {
              $this->session->set_flashdata('registered', 'You are now registered'); // flashata(name of flashdata, message) 
              redirect('products'); 
          }
        }
        
        
    }
    
    public function login() {
        
         $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[16]');
         $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[50]');
        
        $username = $this->input->post('username'); 
        $password = md5($this->input->post('password')); 
        
        $user_id = $this->User_model->login($username, $password); 
        
        // validate user 
         if($user_id){ //if $user_id model works 
             //Create array of user data
             $data = array(
                       'user_id'   => $user_id,
                       'username'  => $username,
                       'logged_in' => true
             );
			//Set session userdata
             // set_userdata is a function 
			$this->session->set_userdata($data);
                   
			//Set message
			$this->session->set_flashdata('pass_login', 'You are logged in');
			redirect('products');
        } else {
            //Set error
             $this->session->set_flashdata('fail_login', 'Sorry, the login info that you entered is invalid');
			redirect('products');
        }
	}
	
	public function logout(){
		//Unset user data
        // unset_userdata is a function 
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();

        redirect('products');
	}
    
    public function account(){
       
        $user_id = $this->session->userdata('user_id'); 
        //'accounts' is the key
        $data['account'] = $this->User_model->get_db_customer_info($user_id);
        //$data['order'] = $this->User_model->get_db_customer_order($user_id);
       
        
        $data['main_content'] = 'accounts'; //--> load account view 
        $this->load->view('layouts/main', $data); 
          
    }
       
}