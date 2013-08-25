<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
		public function index()
	{
		$this->load->model('profile');
		$data['top10_profiles'] = $this->profile->get_top10();
		$this->load->view('mainpage', $data);
	}
}
