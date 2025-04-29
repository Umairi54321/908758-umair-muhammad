<?php

class MY_Loader extends CI_Loader {
	public function adminTemplate($template_name, $vars = array(), $return = FALSE){
		if($return){
		 $content  = $this->view('blocks/header_scripts', $vars, $return);
		 $content .= $this->view('blocks/navbar', $vars, $return);
		 $content .= $this->view('blocks/sidebar', $vars, $return);
		 $content .= $this->view($template_name, $vars, $return);
		 $content .= $this->view('blocks/footer', $vars, $return);
		 $content .= $this->view('blocks/footer_scripts', $vars, $return);
		 return $content;
	 }else{
		 $this->view('blocks/header_scripts', $vars);
		 $this->view('blocks/navbar', $vars);
		 $this->view('blocks/sidebar', $vars);
		 $this->view($template_name, $vars);
		 $this->view('blocks/footer', $vars);
		 $this->view('blocks/footer_scripts', $vars);
	 }
 }


 public function render404() {
	$instance =& get_instance();
	$instance->output->set_status_header('404');
	$instance->load->view('blocks/header_scripts'); 
	$instance->load->view('blocks/header');    
	$instance->load->view('errors/error'); 
	$instance->load->view('blocks/footer'); 
	$instance->load->view('blocks/footer_scripts'); 
}
}