<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Games2v2 extends CI_Model {
	
	var $map = "";
	var $handle_w1 = "";
	var $rating_w1 = "";
	var $handle_w2 = "";
	var $rating_w2 = "";
	var $handle_l1 = "";
	var $rating_l1 = "";
	var $handle_l2 = "";
	var $rating_l2 = "";
	var $faction_w1 = "";
	var $faction_w2 = "";
	var $faction_l1 = "";
	var $faction_l2 = "";
	var $leader_w1 = "";
	var $leader_w2 = "";
	var $leader_l1 = "";
	var $leader_l2 = "";
	//Loser positions are not in DB yet - TODO!
	var $winner1 = "";
	var $winner2 = "";
	
	var $replay = "";
	var $date = "";
		
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function get_all_games(){
		$this->db->limit(100);
		$this->db->order_by("date", "desc");
		$this->db->from('games2v2');
		$query = $this->db->get();
		return $query->result();
	}
    
    public function get_games_of($handle){
		$this->db->where('handle_w1', $handle);
		$this->db->or_where('handle_w2', $handle);
		$this->db->or_where('handle_l1', $handle);
		$this->db->or_where('handle_l2', $handle);
		$this->db->order_by("date", "desc");
		$this->db->from('games2v2');
		$query = $this->db->get();
		return $query->result();
	}
    
    public function get_game($game_id){
		$this->db->where('id', $game_id);
		$this->db->from('games2v2');
		$query = $this->db->get();
		return $query->result();
	}
    
    public function add_game($winner_rating1, $winner_rating2, $loser_rating1, $loser_rating2){
		$this->map = $_POST['map'];
		$this->winner1 = $_POST['winner1'];
		$this->winner2 = $_POST['winner2'];
		
		$this->rating_w1 = $winner_rating1;
		$this->rating_w2 = $winner_rating2;
		$this->rating_l1 = $loser_rating1;
		$this->rating_l2 = $loser_rating2;
		
		
		$this->handle_w1 = $_POST['winner_handle1'];
		$this->handle_w2 = $_POST['winner_handle2'];
		$this->handle_l1 = $_POST['loser_handle1'];
		$this->handle_l2 = $_POST['loser_handle2'];
		
		$this->faction_w1 = $_POST['winner_faction1'];
		$this->faction_w2 = $_POST['winner_faction2'];
		$this->faction_l1 = $_POST['loser_faction1'];
		$this->faction_l2 = $_POST['loser_faction2'];
		
		$this->leader_w1 = "TODO";
		$this->leader_w2 = "TODO";
		$this->leader_l1 = "TODO";
		$this->leader_l2 = "TODO";
		
		if($_POST['replay'] != "")
			$this->replay=$_POST['replay'];
		else
			$this->replay="#";
		$this->date = date('Y-m-d H:i:s');
		$this->db->insert('games2v2', $this);
	}
    
}

?>
