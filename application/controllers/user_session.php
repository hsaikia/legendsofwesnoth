<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_session extends CI_Controller {
	public function login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$remember = FALSE;
		if(isset($_POST['remember']) && $_POST['remember'] == 'true')
			$remember = TRUE;
		
		//TODO : Have to send proper error message in case if failed login
		
		$success = $this->ion_auth->login($email, $password);
		$this->load->model('profile');
		$data['top10_profiles'] = $this->profile->get_top10();
		$data['top10_profiles_2v2'] = $this->profile->get_top10_2v2();
		$this->load->view('mainpage', $data);
	}
	public function logout(){
		$this->ion_auth->logout();
		$this->load->view('mainpage');
	}
	public function register(){
		$this->load->view('forms/register_new');
	}
	public function get_faq(){
		$this->load->view('faq.php');
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

		$this->form_validation->set_error_delimiters('<div class="error"><b>', '</b></div>');
		$this->form_validation->set_rules('handle', 'Handle', 'trim|required|alpha_dash|min_length[3]|is_unique[profiles.handle]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[repassword]|min_length[6]');
		$this->form_validation->set_rules('repassword', 'Retype Password', 'trim|required');
		$this->form_validation->set_rules('email', 'Email address', 'trim|required|valid_email|is_unique[profiles.email]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('forms/register_new');
		}
		else
		{
			$this->ion_auth->register($username, $password, $email, $additional_data, $group);
			$this->load->model('profile');
			$this->profile->add_profile();
			$this->load->view('registration_success');
		}
	}
	
	public function modify_user(){
		$username = $this->ion_auth->user()->row()->username;
		$data['avatar'] = "/assets/images/avatars/" . $_POST['avatar'];
		$data['gender'] = $_POST['gender'];
		$data['country'] = "/assets/images/flags/" . $_POST['country'] . ".png";
		$data['quote'] = $_POST['quote'];
		$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[repassword]|min_length[6]');
		$this->form_validation->set_rules('repassword', 'Retype Password', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="error"><b>', '</b></div>');
		if ($this->form_validation->run() == FALSE){
			$this->modify();
		} else {	
			$this->load->model('profile');
			$this->profile->modify_profile($username, $data);
			$this->load->view('modify_success');
		}
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
	
	public function view_players2v2(){
		$this->load->model('profile');
		$profiles = $this->profile->get_profiles_2v2();
		$data['profiles'] = $profiles;
		$this->load->view('players2v2', $data);
	}
	
	public function view_all_games(){
		$this->load->model('games');
		$games = $this->games->get_all_games();
		$data['games'] = $games;
		$this->load->view('games', $data);
	}
	
	public function view_all_games_2v2(){
		$this->load->model('games2v2');
		$games = $this->games2v2->get_all_games();
		$data['games'] = $games;
		$this->load->view('games2v2', $data);
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
