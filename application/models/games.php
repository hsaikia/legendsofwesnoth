<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Games extends CI_Model {
	
	var $map = "";
	var $handle_p1 = "";
	var $rating_p1 = "";
	var $handle_p2 = "";
	var $rating_p2 = "";
	var $faction_p1 = "";
	var $faction_p2 = "";
	var $leader_p1 = "";
	var $leader_p2 = "";
	var $winner = "";
	var $sports_p1 = "";
	var $sports_p2 = "";
	var $replay = "";
	var $date = "";
		
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function get_all_games(){
		$this->db->limit(100);
		$this->db->order_by("date", "desc");
		$this->db->from('games');
		$query = $this->db->get();
		return $query->result();
	}
    
    public function get_games_of($handle){
		$this->db->where('handle_p1', $handle);
		$this->db->or_where('handle_p2', $handle);
		$this->db->order_by("date", "desc");
		$this->db->from('games');
		$query = $this->db->get();
		return $query->result();
	}
    
    public function get_game($game_id){
		$this->db->where('id', $game_id);
		$this->db->from('games');
		$query = $this->db->get();
		return $query->result();
	}
    
    public function add_game($winner_rating, $loser_rating){
		$this->map = $_POST['map'];
		$this->winner = $_POST['winner'];
		if($_POST['winner'] == "P1"){
			$this->rating_p1 = $winner_rating;
			$this->rating_p2 = $loser_rating;
			$this->handle_p1 = $_POST['winner_handle'];
			$this->handle_p2 = $_POST['loser_handle'];
			$this->sports_p1 = "-1";
			$this->sports_p2 = $_POST['sports'];
			$this->faction_p1 = $_POST['winner_faction'];
			$this->faction_p2 = $_POST['loser_faction'];
		} else {
			$this->rating_p1 = $loser_rating;
			$this->rating_p2 = $winner_rating;
			$this->handle_p1 = $_POST['loser_handle'];
			$this->handle_p2 = $_POST['winner_handle'];
			$this->sports_p1 = $_POST['sports'];
			$this->sports_p2 = "-1";
			$this->faction_p2 = $_POST['winner_faction'];
			$this->faction_p1 = $_POST['loser_faction'];
		}
		$this->leader_p1 = "TODO";
		$this->leader_p2 = "TODO";
		if($_POST['replay'] != "")
			$this->replay=$_POST['replay'];
		else
			$this->replay="#";
			
		$this->date = date('Y-m-d H:i:s');
		$this->db->insert('games', $this);
	}
    
}

?>
