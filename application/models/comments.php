<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends CI_Model {
	var $game_id = "";
	var $handle = "";
	var $date = "";
	var $text = "";
	
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	public function add($game_id){
		
		if($_POST['my_comment'] == "")
			return;
		
		$this->game_id = $game_id;
		$this->handle = $_POST['my_handle'];
		$this->text = $_POST['my_comment'];
		$this->date = date('Y-m-d H:i:s');
		$this->db->insert('comments', $this);
	}
	
	public function get_comments($game_id){
		$this->db->select('*');
		$this->db->where('game_id', $game_id);
		$this->db->from('comments');
		$this->db->join('profiles', 'comments.handle = profiles.handle');
		$query = $this->db->get();
		return $query->result();
	}

	public function add_2v2($game_id){
		
		if($_POST['my_comment'] == "")
			return;
		
		$this->game_id = $game_id;
		$this->handle = $_POST['my_handle'];
		$this->text = $_POST['my_comment'];
		$this->date = date('Y-m-d H:i:s');
		$this->db->insert('comments2v2', $this);
	}
	
	public function get_comments_2v2($game_id){
		$this->db->select('*');
		$this->db->where('game_id', $game_id);
		$this->db->from('comments2v2');
		$this->db->join('profiles', 'comments2v2.handle = profiles.handle');
		$query = $this->db->get();
		return $query->result();
	}

}

?>
