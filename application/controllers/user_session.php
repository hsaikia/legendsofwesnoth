<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_session extends CI_Controller {
	public function login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$remember = FALSE;
		if(isset($_POST['remember']) && $_POST['remember'] == 'true')
			$remember = TRUE;
		$success = $this->ion_auth->login($email, $password);
		$this->load->model('profile');
		$data['top10_profiles'] = $this->profile->get_top10();
		$this->load->view('mainpage', $data);
	}
	public function logout(){
		$this->ion_auth->logout();
		$this->load->view('mainpage');
	}
	public function register(){
		$this->load->view('forms/register_new');
	}
	public function register_user(){
		$username = $_POST['handle'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$additional_data = array(
								'first_name' => 'anon',
								'last_name' => 'anon',
								);
		$group = array('2'); 

		$this->ion_auth->register($username, $password, $email, $additional_data, $group);
		$this->load->model('profile');
		$this->profile->add_profile();
		$this->load->view('registration_success');
	}
	
	public function modify_user(){
		$username = $this->ion_auth->user()->row()->username;
		$data['avatar'] = "/assets/images/avatars/" . $_POST['avatar'] . ".png";
		$data['gender'] = $_POST['gender'];
		$data['country'] = "/assets/images/flags/" . $_POST['country'] . ".png";
		$data['quote'] = $_POST['quote'];
		$this->load->model('profile');
		$this->profile->modify_profile($username, $data);
		$this->load->view('modify_success');
	}
	
	public function modify(){
		$username = $this->ion_auth->user()->row()->username;
		$this->load->model('profile');
		$profile = $this->profile->get_profile($username);
		$data['profile'] = reset($profile);
		$this->load->view('forms/modify_profile', $data);
	}
	
	public function view_profile($username){
		$this->load->model('profile');
		$profile = $this->profile->get_profile($username);
		//$data = reset($profile); // $profile is an array, reset() returns the first element, in this case the first row (there should be only one :D)
		$this->load->model('games');
		$games = $this->games->get_games_of($username);
		$data['profile'] = reset($profile);
		$data['games'] = $games;
		$data['rank'] = $this->profile->get_rank($data['profile']->rating);
		$this->load->view('profile_view', $data);
	}
	
	public function view_profile_2v2($username){
		$this->load->model('profile');
		$profile = $this->profile->get_profile($username);
		//$data = reset($profile); // $profile is an array, reset() returns the first element, in this case the first row (there should be only one :D)
		$this->load->model('games2v2');
		$games = $this->games2v2->get_games_of($username);
		$data['profile'] = reset($profile);
		$data['games'] = $games;
		$data['rank'] = $this->profile->get_rank_2v2($data['profile']->rating2v2);
		$this->load->view('profile_view2v2', $data);
	}
	
	public function view_players(){
		$this->load->model('profile');
		$profiles = $this->profile->get_profiles();
		$data['profiles'] = $profiles;
		$this->load->view('players', $data);
	}
	
	public function view_all_games(){
		$this->load->model('games');
		$games = $this->games->get_all_games();
		$data['games'] = $games;
		$this->load->view('games', $data);
	}
	
	public function get_handles(){
		$partial_handle = $this->input->post('term');
		//echo json_encode(array('hey!', $partial_handle));
		
		$this->load->model('profile');
		$rows = $this->profile->get_handles($partial_handle);
		$json_array = array();
		foreach ($rows as $row)
			array_push($json_array, $row->handle);

		echo json_encode($json_array);
	}
}

?>
