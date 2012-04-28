<?php




class Forms {
    //put your code here

    public $CI;

    function  __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('table');
        $this->CI->load->helper('form');
    }



    
}
?>
