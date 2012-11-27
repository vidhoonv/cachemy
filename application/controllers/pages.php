<?php


class Pages extends CI_Controller {

	public function view($page = 'login')
	{
		if(!file_exists('application/views/pages/'.$page.'.php'))
		{
			show_404();
		}
		
		$data['title'] = ucfirst($page);
		
		//$this->load->view('templates/header',$data);
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->view('pages/'.$page,$data);
		//$this->load->view('templates/footer',$data);		
	}
}

?>
