<?php 

ob_start(); // to remove header error

class cart extends CI_Controller {
    //public $paypal_data = ''; 
    // tax and shipping is stored in teh config file as custom Config
    public $tax = 2.00; 
    public $shipping = 5.00; 
    public $total = 0; 
    public $grand_total; 
    
    /*
    
    cart index 
    
    */
    
    public function index() {
        // load view 
        $data['main_content'] = 'cart'; 
        $this->load->view('layouts/main', $data); 
    }
    
    /*
    
        Add to cart
    */
    
    
    // create an array for item data
    public function add() {
        $data = array(
                
                // item_number is from the form name being submitted in products view 
                //  post is equivelant as $_POST 
                'id' => $this->input->post('item_number'), 
                'qty' => $this->input->post('qty'), 
                'price' => $this->input->post('price'), 
                'name' => $this->input->post('title')
        ); 
        
    
        // make sure you load cart library to use 
        // load in config in autoload : $autoload['libraries'] = array('database', 'cart');
        // also include sessions in the config.php : $config['encryption_key'] = '12345';
        $this->cart->insert($data); 
       	redirect('products');
        
       
    }
    
    /*
        
        Update Cart 
        
    */
    
    public function update($in_cart = null) {
        $data = $_POST; 
        $this->cart->update($data); 
        
        //Show Cart Page
        redirect('cart', 'refresh'); 
    }
    
    /*
	 *	Process Form
	 */
	 public function process(){
		if($_POST){
			foreach($this->input->post('item_name') as $key => $value){
				//Get tax & shipping from config
				$this->tax = 'tax';
				$this->shipping = 'shipping';
			
				$item_id = $this->input->post('item_code')[$key]; 
				$product = $this->Product_model->get_product_details($item_id);
				
				//Price x Quanity
				$subtotal = ($product->price * $this->input->post('item_qty')[$key]);
				$this->total = $this->total + $subtotal;
				
				//Create Order Array
				$order_data = array(
				'product_id' 		=> $item_id,
				'user_id'  			=> $this->session->userdata('user_id'),
				'transaction_id'  	=> 0,
				'qty'            	=> $this->input->post('item_qty')[$key],
				'price'      		=> $subtotal,
				'address'   		=> $this->input->post('address'),
				'address2'      	=> $this->input->post('address2'),
				'city'      		=> $this->input->post('city'),
				'state'      		=> $this->input->post('state'),
				'zipcode'      		=> $this->input->post('zipcode')
				);
				
				//Add Order Data
				$this->Product_model->add_order($order_data);
			}
			
			//Get Grand Total
			$this->grand_total = $this->total + $this->tax + $this->shipping;
			
			//Create Array Of Costs
			$paypal_product['assets'] = array(
					'tax_total'     => $this->tax,
					'shipping_cost' =>$this->shipping,
					'grand_total'   =>$this->total);
					
					
					//Load View
					$data['main_content'] = 'thankyou';
					$this->load->view('layouts/main', $data);
													
			}
	 }
}