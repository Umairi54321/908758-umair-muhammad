<?php
defined('BASEPATH') or exit('No direct script access allowed');
class StaticPages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data = array();
        $this->load->Template('static_pages/home', $data);  
    }

    public function contactUs()
    {
        $data = array();
        $this->load->Template('static_pages/contact-us', $data);  
    }

    public function faq()
    {
        $data = array();
        $this->load->Template('static_pages/faq', $data);  
    }


    public function aboutUs()
    {
        $data = array();
        $this->load->Template('static_pages/about-us', $data);  
    }


 

   


    
  
}
