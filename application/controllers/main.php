<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
		public function index()
	{
		$this->load->model('profile');
		$data['top10_profiles'] = $this->profile->get_top10();
		$data['top10_profiles_2v2'] = $this->profile->get_top10_2v2();
		$this->load->view('mainpage', $data);
	}
}
