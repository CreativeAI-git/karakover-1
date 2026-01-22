<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Adminn extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('common');
    }

   public function uploadSongsNew()
    { 

        echo $_SERVER["REQUEST_METHOD"] == "POST";
        pre($_REQUEST);
        pre("aaaaaa");
        pred($this->input->post());
    }


} // End Home controller Here.
