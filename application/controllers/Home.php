<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/index';
		$data['home'] = $this->common->getData('web_home', array(), array());
		$data['bgimage'] = $this->common->getData('web_bgimage', array());
		$data['about'] = $this->common->getData('web_about', array(), array());
		$data['instrument'] = $this->common->getData('web_instrument', array());
		$data['footer'] = $this->common->getData('web_footer', array(), array());
		$this->load->view('frontend/include/index', $data);
	}

	public function about()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/about';
		$data['about'] = $this->common->getData('web_about', array(), array());
		$data['bgimage'] = $this->common->getData('web_bgimage', array());
		$data['ourteam'] = $this->common->getData('web_ourteam', array());
		$data['footer'] = $this->common->getData('web_footer', array(), array());
		$this->load->view('frontend/include/index', $data);
	}

	public function instruments()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/instruments';
		$data['instrument'] = $this->common->getData('web_instrument', array());
		$data['bgimage'] = $this->common->getData('web_bgimage', array());
		$data['footer'] = $this->common->getData('web_footer', array(), array());
		$this->load->view('frontend/include/index', $data);
	}

	public function tutorials()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/tutorials';
		$data['tutorial'] = $this->common->getData('web_tutorial', array());
		$data['bgimage'] = $this->common->getData('web_bgimage', array());
		$data['footer'] = $this->common->getData('web_footer', array(), array());
		$this->load->view('frontend/include/index', $data);
	}

	public function chatroom()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/chatroom';
		$data['footer'] = $this->common->getData('web_footer', array(), array());
		$data['bgimage'] = $this->common->getData('web_bgimage', array());
		$this->load->view('frontend/include/index', $data);
	}
}
