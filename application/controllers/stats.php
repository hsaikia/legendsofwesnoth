<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stats extends CI_Controller {
	public function get_map_stats($map_code){
		$this->load->model('games');
		$data['games'] = $this->games->get_games_in($map_code);
		$data['map'] = $map_code;
		$this->load->view('map_view', $data); 
	}

	public function get_map_stats2v2($map_code){
		$this->load->model('games2v2');
		$data['games'] = $this->games2v2->get_games_in($map_code);
		$data['map'] = $map_code;
		$this->load->view('map_view', $data); 
	}
	
	public function get_faction_stats($faction){
		$this->load->model('games');
		$data['games'] = $this->games->get_games_with($faction);
		$data['race'] = $faction;
		$this->load->view('faction_view', $data);
	}
	
}

?>
