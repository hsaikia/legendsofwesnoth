<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_game extends CI_Controller {
	
	public function add_comment($game_id){
		$this->load->model('comments');
		$this->comments->add($game_id);
		$this->load->view('comment_success');
	}
	
	public function discuss($game_id){
		$this->load->model('games');
		$game = $this->games->get_game($game_id);
		$data['game'] = reset($game);
		
		$this->load->model('comments');
		$comments = $this->comments->get_comments($game_id);
		$data['comments'] = $comments;
		$this->load->view('game_page', $data);
	}
	
	public function add_comment_2v2($game_id){
		$this->load->model('comments');
		$this->comments->add_2v2($game_id);
		$this->load->view('comment_success');
	}
	
	public function discuss_2v2($game_id){
		$this->load->model('games2v2');
		$game = $this->games2v2->get_game($game_id);
		$data['game'] = reset($game);
		
		$this->load->model('comments');
		$comments = $this->comments->get_comments_2v2($game_id);
		$data['comments'] = $comments;
		$this->load->view('game_page2v2', $data);
	}
	
}

?>
