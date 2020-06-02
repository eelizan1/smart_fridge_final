<!--Interacts with teh db using active records-->
<?php

class Product_model extends CI_Model {
    
    // create get product method
    // Uses 'acive record' to interact with the database 
    public function get_products() {
        $this->db->select('*'); 
        $this->db->from('products'); 
        $query = $this->db->get();
        
        // returns the result rows
        return $query->result(); 
    }
    
    /*
        Get single product    
    */
    
    public function get_product_details($id) {
        $this->db->select('*'); 
        $this->db->from('products'); 
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        // returns the result row
        // it is 'row()' since its a single product 
        return $query->row(); 
    }
    
    /*
        Get categories 
    */
    
    public function get_categories() {
        $this->db->select('*'); 
        $this->db->from('categories'); 
        $query = $this->db->get();
        
        // returns the result rows
        return $query->result(); 
        
    }
    
     /*
	 * Get Most Popular Products
    
	*/
	public function get_popular(){
		$this->db->select('P.*, COUNT(O.product_id) as total');
		$this->db->from('orders AS O');
		$this->db->join('products AS P', 'O.product_id = P.id', 'INNER');
		$this->db->group_by('O.product_id');
		$this->db->order_by('total', 'desc'); //get in descending order 
		$query = $this->db->get();
		return $query->result();
	}
    
    /*
	 *	Add Order To Database
	 */
	 public function add_order($order_data){
         $currentDate = date('%m/%d/%Y'); 
		$insert = $this->db->insert('orders', $order_data);
        return $insert;
	}
}