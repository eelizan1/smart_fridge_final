<?php

/**

    Get Categories 

*/


function get_categories_h(){
    // bring a codeigniter instance
    $CI = get_instance(); 
    $categories = $CI->Product_model->get_categories(); 
    
    return $categories;
}

/*

    Get Sidebar most popular

*/

function get_popular_h(){
    $CI =& get_instance(); 
    $CI->load->model('Product_model'); 
    $popular_products = $CI->Product_model->get_products(); 
    
    return $popular_products;
}